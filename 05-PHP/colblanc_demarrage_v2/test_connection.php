<?php
require_once 'dao/Dbconnect.php';

try {
    $db = Dbconnect::getInstance()->getPdo();
    echo "Connexion réussie à la base de données!";
    
    // Test de requête
    $stmt = $db->query("SHOW TABLES");
    echo "<pre>Tables disponibles: ";
    print_r($stmt->fetchAll());
    echo "</pre>";
    
} catch (RuntimeException $e) {
    echo "Erreur: " . $e->getMessage();
}