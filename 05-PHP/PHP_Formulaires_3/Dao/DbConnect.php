<?php
class DbConnect 
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if(self::$instance === null) {
            self::$instance = new PDO(
                'mysql:host=localhost;dbname=db_contact;charset=utf8', 
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