# DDJ Database

Gestion simple de connexions multiples à **MariaDB/MySQL** via PDO.  
Cette librairie fournit une classe `Database` réutilisable, avec configuration centralisée et support multi-bases.

---

## 🚀 Installation

Installez la librairie avec **Composer** :

```bash
composer require ddj/database

⚙️ Configuration

Créez un fichier config/config.php dans votre projet :

<?php
return [
    'default' => [
        'driver'   => 'mariadb',
        'host'     => 'localhost',
        'port'     => 3306,
        'dbname'   => 'ma_base',
        'charset'  => 'utf8mb4',
        'user'     => 'monuser',
        'password' => 'monpass',
    ],
    'backup' => [
        'driver'   => 'mariadb',
        'host'     => '192.168.0.10',
        'port'     => 3306,
        'dbname'   => 'backup',
        'charset'  => 'utf8mb4',
        'user'     => 'backupuser',
        'password' => 'backuppass',
    ],
];

🛠️ Utilisation

<?php
require __DIR__ . '/vendor/autoload.php';

use DDJ\Database;

// Charger la configuration
Database::loadConfig(__DIR__ . '/config/config.php');

// Connexion par défaut
$db = Database::getConnection();
echo "BDD active : " . $db->query("SELECT DATABASE()")->fetchColumn();

// Connexion secondaire (backup)
$backup = Database::getConnection('backup');
echo "Date sur backup : " . $backup->query("SELECT NOW()")->fetchColumn();

📌 Fonctionnalités

    ✅ Gestion de plusieurs bases (default, backup, etc.)

    ✅ Support MariaDB / MySQL (via PDO)

    ✅ Centralisation de la configuration

    ✅ Requêtes sécurisées (PDO avec exceptions et FETCH_ASSOC)

    ✅ Extensible (ajout possible de PostgreSQL/SQLite)

📜 Licence

Distribué sous licence MIT.