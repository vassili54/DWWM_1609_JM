<?php
// controllers/CtrlAuth.php

require_once __DIR__ . '/../models/dao/Connection.php';
require_once __DIR__ . '/../models/dao/UtilisateurDAO.php'; // Nous aurons besoin d'un DAO pour les utilisateurs

/**
 * Gère la logique de connexion de l'utilisateur.
 * Traite le formulaire de connexion et redirige en cas de succès ou d'échec.
 */
function controleurLogin()
{
    // Si le formulaire de connexion a été soumis (méthode POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validation'])) {
        $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_EMAIL); // Nettoyer l'email
        $password = $_POST['pwd']; // Le mot de passe brut

        $utilisateurDAO = new UtilisateurDAO(); // Instancier le DAO utilisateur

        // Tenter d'authentifier l'utilisateur
        // ATTENTION : Cette version ne vérifie PAS le mot de passe pour faciliter les tests.
        // NE PAS UTILISER EN PRODUCTION.
        $user = $utilisateurDAO->authenticateUser($identifiant, $password);

        if ($user) {
            // Authentification réussie
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['user_nom'] = $user['nom_utilisateur'];
            $_SESSION['user_prenom'] = $user['prenom_utilisateur'];
            $_SESSION['user_niveau'] = $user['id_niveau']; // Important pour les droits

            $_SESSION['message_succes'] = "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['prenom_utilisateur']);
            // NOUVEAU : Rediriger vers la page de gestion des biens après une connexion réussie
            header('Location: index.php?action=gestion_biens');
            exit();
        } else {
            // Authentification échouée
            $_SESSION['message_erreur'] = "Identifiant ou mot de passe incorrect.";
            // Rester sur la page de connexion ou rediriger vers elle
            header('Location: index.php?action=login');
            exit();
        }
    }
    // Inclure la vue du formulaire de connexion
    include './views/acces_membre.php';
}

/**
 * Gère la déconnexion de l'utilisateur.
 * Détruit la session et redirige vers l'accueil.
 */
function controleurLogout()
{
    // Détruire toutes les variables de session
    $_SESSION = array();

    // Si vous utilisez des cookies de session, détruisez également le cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalement, détruire la session.
    session_destroy();

    $_SESSION['message_succes'] = "Vous avez été déconnecté.";
    header('Location: index.php?action=accueil'); // Rediriger vers la page d'accueil
    exit();
}
