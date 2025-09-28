<?php
namespace DDJ;

use PDO;
use PDOException;

class Database
{
    private static array $config = [];
    private static array $connections = [];

    public static function loadConfig(string $configFile): void
    {
        if (!file_exists($configFile)) {
            throw new \RuntimeException("Fichier de configuration introuvable: $configFile");
        }
        self::$config = require $configFile;
    }

    private static function buildDsn(array $conf): string
    {
        $driver = strtolower($conf['driver']);

        if ($driver === 'mariadb' || $driver === 'mysql') {
            return sprintf(
                "mysql:host=%s;port=%d;dbname=%s;charset=%s",
                $conf['host'],
                $conf['port'] ?? 3306,
                $conf['dbname'],
                $conf['charset'] ?? 'utf8mb4'
            );
        }

        throw new \InvalidArgumentException("Driver non supporté: " . $conf['driver']);
    }

    public static function getConnection(string $name = 'default'): PDO
    {
        if (!isset(self::$config[$name])) {
            throw new \InvalidArgumentException("Configuration '$name' introuvable.");
        }

        if (!isset(self::$connections[$name])) {
            $conf = self::$config[$name];
            $dsn  = self::buildDsn($conf);

            try {
                $pdo = new PDO($dsn, $conf['user'], $conf['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
                self::$connections[$name] = $pdo;
            } catch (PDOException $e) {
                throw new \RuntimeException("Erreur de connexion à '$name': " . $e->getMessage());
            }
        }

        return self::$connections[$name];
    }
}
