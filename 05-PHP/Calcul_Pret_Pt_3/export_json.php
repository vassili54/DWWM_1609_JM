<?php
// Assurez-vous que le fichier de classe Pret.php est inclus
require_once 'classes/Pret.php';

// Définir le type de contenu de la réponse comme JSON
header('Content-Type: application/json');

// Définir les en-têtes pour forcer le téléchargement du fichier
header('Content-Disposition: attachment; filename="tableau_amortissement.json"');

// Récupérer les données envoyées par le formulaire POST
$montant = $_POST['montant_pret'] ?? null;
$taux = $_POST['taux_interet'] ?? null;
$duree = $_POST['duree_pret_annees'] ?? null;

$response = []; // Tableau pour stocker la réponse (données JSON ou erreur)

// Validation basique des données reçues
if ($montant === null || $taux === null || $duree === null || !is_numeric($montant) || !is_numeric($taux) || !is_numeric($duree) || $montant <= 0 || $taux < 0 || !is_int((int)$duree) || (int)$duree <= 0) {
    // Si les données sont invalides, envoyer une erreur
    http_response_code(400); // Bad Request
    $response = ['error' => 'Paramètres de prêt invalides ou manquants.'];

} else {
    try {
        // Convertir les valeurs en types appropriés
        $montant = (float) $montant;
        $taux = (float) $taux;
        $duree = (int) $duree;

        // Créer un objet Pret
        $objmonPret = new Pret($montant, $taux, $duree);

        // Obtenir les données d'amortissement sous forme de tableau
        $tableau_data = $objmonPret->getTableauAmortissement();

        // Stocker les données d'amortissement dans la réponse
        $response = $tableau_data;

    } catch (Exception $e) {
        // Gérer les exceptions de la classe Pret (bien que la validation préalable devrait en éviter la plupart)
        http_response_code(500); // Internal Server Error
        $response = ['error' => 'Erreur lors du calcul de l\'amortissement: ' . $e->getMessage()];
    }
}

// Envoyer la réponse finale en JSON
echo json_encode($response, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT pour un JSON plus lisible
exit; // Arrêter l'exécution du script
?>