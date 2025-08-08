<?php
// C:\laragon\www\ProjetFileRouge\index.php

session_start();

ob_start(); // Démarre la mise en mémoire tampon de sortie

/* HEADER entête avec dépendances CSS */
include "views/header.php";

/* NAVBAR */
include "views/menu.php";

/* Carousel */
// Le slider est généralement sur la page d'accueil, pas forcément toutes les pages.
// Cette inclusion reste ici pour ne pas modifier la structure actuelle et le laisser prendre toute la largeur.
include "views/slider.php";


// Inclusion des fichiers de contrôleurs
require_once "controllers/CtrlAccueil.php";
require_once "controllers/CtrlFiltre.php";
require_once "controllers/CtrlMiseAjour.php";
require_once "controllers/CtrlAuth.php"; // NOUVEAU : Inclure le contrôleur d'authentification

// Début du routeur
$action = $_GET['action'] ?? 'accueil'; // Si aucune action n'est définie, on va à l'accueil par défaut

// Vérifier si l'utilisateur est connecté et récupérer son niveau pour les actions protégées
$isLoggedIn = isset($_SESSION['user_id']);
$userNiveau = $_SESSION['user_niveau'] ?? null; // Récupérer le niveau de l'utilisateur

switch ($action) {
    case 'accueil':
        afficherAccueil();
        break;
    case 'filtre':
        controleurFiltre();
        break;
    case 'login':
        // Le contrôleur de login gère l'affichage du formulaire et le traitement de la soumission.
        // Il inclura views/acces_membre.php lui-même.
        controleurLogin();
        break;
    case 'logout':
        controleurLogout(); // Gère la déconnexion
        break;
    case 'modifier': // Affichage du formulaire de modification
    case 'maj_bien': // Soumission du formulaire de modification
        // Vérifier si l'utilisateur est connecté ET a le bon niveau d'habilitation (Superadmin ou Agent_commercial)
        if ($isLoggedIn && ($userNiveau == 1 || $userNiveau == 2)) {
            if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
                $idBien = (int)$_GET['id'];
                controleurMajBien($idBien);
            } else {
                $_SESSION['message_erreur'] = "ID de bien invalide ou manquant pour la modification.";
                header('Location: index.php?action=accueil');
                exit();
            }
        } else {
            // Rediriger vers la page de connexion si non connecté ou non autorisé
            $_SESSION['message_erreur'] = "Accès non autorisé. Veuillez vous connecter avec les droits nécessaires.";
            header('Location: index.php?action=login');
            exit();
        }
        break;
    case 'gestion_biens': // NOUVELLE ACTION : Afficher la liste des biens de l'agent/admin
        if ($isLoggedIn && ($userNiveau == 1 || $userNiveau == 2)) {
            // Nous allons réutiliser afficherAccueil mais en lui indiquant de filtrer par user_id
            // La logique de filtrage sera gérée dans CtrlAccueil.php et BienImmobilierDAO.php
            afficherAccueil(); // Cette fonction sera adaptée pour gérer le filtrage par utilisateur
        } else {
            $_SESSION['message_erreur'] = "Accès non autorisé. Veuillez vous connecter.";
            header('Location: index.php?action=login');
            exit();
        }
        break;
    default:
        // Si l'action n'est pas reconnue
        afficherAccueil();
        break;
}

// L'ancienne inclusion du panneau d'accès membre (views/acces_membre.php) est retirée d'ici
// car il est maintenant inclus directement par controleurLogin() quand l'action est 'login'.
// Cela évite de l'afficher sur toutes les pages sauf la page de connexion.
// include("views/acces_membre.php"); // Ligne à commenter ou supprimer

/* Pied de page avec dépendances Javascript... */
include("views/footer.php");

ob_end_flush(); // Envoie la sortie du tampon et désactive la mise en mémoire tampon

?>