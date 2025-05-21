<?php
require_once './RestoRepository.php';

// Indique au navigateur que la réponse est du JSON
header('Content-Type: application/json');

$repo = new RestoRepository();

try {
    // Récupérer les données des restaurants
    $restaurants = $repo->searchAll();

    // Convertir en JSON et l'afficher directement
    // Utilisez JSON_PRETTY_PRINT pour une meilleure lisibilité dans le navigateur
    echo json_encode($restaurants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    // En cas d'erreur, renvoyer un JSON d'erreur et un code de statut HTTP 500
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la récupération ou de l\'affichage du JSON : ' . $e->getMessage()]);
}
?>
