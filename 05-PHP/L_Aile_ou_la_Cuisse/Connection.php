<?php
class Connection
{
    private static ?PDO $instance = null;
    private const HOST = 'localhost';
    private const DB_NAME = 'Guide';
    private const USER = 'root';
    private const PASS = '';
    private const CHARSET = 'utf8mb4';

    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    sprintf('mysql:host=%s;dbname=%s;charset=%s', self::HOST, self::DB_NAME, self::CHARSET),
                    self::USER,
                    self::PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::ATTR_STRINGIFY_FETCHES => false
                    ]
                );
            } catch (PDOException $e) {
                error_log('Database connection error: ' . $e->getMessage());
                throw new RuntimeException('Database connection failed');
            }
        }
        return self::$instance;
    }
}

