<?php
require_once __DIR__ . '/DbConnect.php';

class ContactRepository 
{
    public static function insertMessage(
        string $nom, 
        string $dateNaissance, 
        string $email, 
        string $message
    ): bool {
        $db = DbConnect::getInstance();
        
        $stmt = $db->prepare("
            INSERT INTO tbl_contact 
            (nom, date_naissance, email, message) 
            VALUES (:nom, :date_naissance, :email, :message)
        ");
        
        return $stmt->execute([
            ':nom' => $nom,
            ':date_naissance' => $dateNaissance,
            ':email' => $email,
            ':message' => $message
        ]);
    }
}