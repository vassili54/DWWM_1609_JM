<?php
// config/database.php
class DB {
    private static $instance;
    
    public static function connect() {
        if (!self::$instance) {
            self::$instance = new PDO(
                'mysql:host=localhost;dbname=excavator',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
        return self::$instance;
    }
}
?>