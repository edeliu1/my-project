<?php

class Database {
    private PDO $pdo;

    public function __construct(array $config) {
        $host = $config['host'] ?? '127.0.0.1';
        $db   = $config['db'] ?? '';
        $user = $config['user'] ?? 'root';
        $pass = $config['pass'] ?? '';
        $charset = $config['charset'] ?? 'utf8mb4';

        if (trim($db) === '') {
            throw new Exception("Missing database name in config.php");
        }

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}
