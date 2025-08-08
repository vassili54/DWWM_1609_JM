<?php
// C:\laragon\www\ProjetFileRouge\models\dao\Connection.php

// PAS de namespace Dba; ICI

class Connection {
    private static $pdoInstance = null;

    private static $host = 'localhost';
    private static $db_name = 'immochateau';
    private static $username = 'root';
    private static $password = '';
    private static $charset = 'utf8';

    private function __construct() {
        // ...
    }

    public static function getInstance() {
        if (self::$pdoInstance === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=" . self::$charset;

            try {
                self::$pdoInstance = new PDO($dsn, self::$username, self::$password);
                self::$pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Erreur de connexion à la base de données: " . $e->getMessage());
                die("Erreur de connexion à la base de données. Veuillez réessayer plus tard. Détail: " . $e->getMessage());
            }
        }
        return self::$pdoInstance;
    }
}
?>