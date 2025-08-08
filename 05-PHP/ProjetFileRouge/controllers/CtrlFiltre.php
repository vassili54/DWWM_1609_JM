<?php
// ProjetFileRouge/controllers/CtrlFiltre.php

function controleurFiltre()
{
    require_once __DIR__ . '/../models/dao/BienImmobilierDAO.php';
    $biensDAO = new BienImmobilierDAO(); // Renommé pour cohérence avec BienImmobilierDAO

    $departements = $biensDAO->getDepartements(); // Ajouté pour que la vue filtre ait accès aux départements
    $categories = $biensDAO->getCategories();   // Ajouté pour que la vue filtre ait accès aux catégories

    $selectedDep = $_GET['dep'] ?? '';
    $selectedBudget = $_GET['budget'] ?? '';
    $selectedNbPieces = $_GET['nbpieces'] ?? '';
    $selectedCategory = $_GET['categorie'] ?? '';

    // NOUVEAU : Récupérer l'ID de l'utilisateur connecté et appliquer le filtre selon son niveau
    $id_utilisateur_commercial = null; // Par défaut, pas de filtre par utilisateur (pour le Superadmin ou non connecté)

    // Si l'action est 'gestion_biens' ET qu'un utilisateur est connecté
    if (isset($_GET['action']) && $_GET['action'] === 'gestion_biens' && isset($_SESSION['user_id'])) {
        // Si l'utilisateur est un Agent Commercial (niveau 2), on filtre par son ID
        if (isset($_SESSION['user_niveau']) && $_SESSION['user_niveau'] == 2) {
            $id_utilisateur_commercial = $_SESSION['user_id'];
        }
        // Si l'utilisateur est un Superadmin (niveau 1), $id_utilisateur_commercial reste null.
    }

    // Appel de la méthode getAllBiens avec les paramètres de recherche et l'ID utilisateur
    $tableauBiens = $biensDAO->getAllBiens( // Renommé $biens en $tableauBiens pour cohérence avec CtrlAccueil
        $selectedDep,
        $selectedBudget,
        $selectedNbPieces,
        $selectedCategory,
        $id_utilisateur_commercial // Passer l'ID de l'utilisateur pour le filtrage
    );

    // NOUVEAU : Inclure la vue appropriée en fonction de l'action
    if (isset($_GET['action']) && $_GET['action'] === 'gestion_biens') {
        // Pour la gestion des biens, inclure la vue tableau
        include './views/gestion_biens_tableau.php';
    } else {
        // Pour l'accueil, inclure la vue en cartes
        include './views/accueil.php';
    }
}
