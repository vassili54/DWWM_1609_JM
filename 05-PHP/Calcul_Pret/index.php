<?php
// Chargement des classes nécessaires
require_once 'classes/Pret.php';
require_once 'controllers/PretController.php';
// Instanciation du contrôleur principal
$controller = new PretController();
// Gestion de la requête utilisateur
$controller->gererRequete();
?>