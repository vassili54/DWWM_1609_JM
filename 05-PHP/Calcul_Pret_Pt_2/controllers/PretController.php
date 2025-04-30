<?php
// Inclusion de la classe Pret
require_once './classes/Pret.php';
/**
 * Contrôleur principal - Gère la logique métier
 */
class PretController {
    /**
     * Méthode principale pour gérer la requête
     */
    public function gererRequete() {
        // Récupération et nettoyage des données du formulaire
        $donnees = [
            'montant' => $_POST['montant_pret'] ?? '', // Valeur par défaut si non définie
            'taux' => $_POST['taux_interet'] ?? '',
            'duree' => $_POST['duree_pret_annees'] ?? '',
            'tableau_html' => '',
            'tableau_array' => []
        ];

        $resultat = null; // Variable pour stocker le résultat du calcul

        // Vérifie si le formulaire a été soumis (méthode POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Conversion et validation des données
                $montant = floatval($donnees['montant']);
                $taux = floatval($donnees['taux']);
                $duree = intval($donnees['duree']);

                // Validation métier
                if ($montant <= 0 || $duree <= 0) {
                    throw new Exception("Le montant et la durée doivent être positifs");
                }

                // Création de l'objet Pret et calculs
                $pret = new Pret($montant, $taux, $duree);
                $resultat = $pret->calculMensualite();

                // Génération des tableaux d'amortissement
                $donnees['tableau_html'] = $pret->tableauAmortissement();
                $donnees['tableau_array'] = $pret->getTableauAmortissement();

            } catch (Exception $e) {
                // Gestion des erreurs
                $resultat = $e->getMessage();
            }
        }
        // Inclusion de la vue (affichage)
        require './views/form.php';
    }
}



?>