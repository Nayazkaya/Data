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
