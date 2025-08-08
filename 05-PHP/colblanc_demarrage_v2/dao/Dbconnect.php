<?php
// dao/Dbconnect.php
class Dbconnect {
    private static $instance = null;
    private PDO $pdo;

    private function __construct() {
        $config = require __DIR__ . '/../config/config.php';
        $this->pdo = new PDO(
            'mysql:host='.$config['host'].';dbname='.$config['dbname'],
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}