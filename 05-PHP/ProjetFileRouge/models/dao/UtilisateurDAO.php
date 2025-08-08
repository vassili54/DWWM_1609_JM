<?php
// models/dao/UtilisateurDAO.php

// Inclure le fichier de connexion à la base de données
require_once __DIR__ . '/Connection.php';

class UtilisateurDAO
{
    /**
     * Authentifie un utilisateur en vérifiant son email.
     * ATTENTION : Cette version ne vérifie PAS le mot de passe pour faciliter les tests.
     * NE PAS UTILISER EN PRODUCTION.
     * @param string $email L'email de l'utilisateur.
     * @param string $password Le mot de passe brut fourni par l'utilisateur (ignoré dans cette version).
     * @return array|false Retourne un tableau associatif des données de l'utilisateur si l'email existe,
     * false sinon (utilisateur non trouvé).
     */
    public function authenticateUser(string $email, string $password) // Le paramètre $password est conservé pour la compatibilité mais ignoré
    {
        try {
            // Obtenir l'instance de connexion PDO
            $pdo = Connection::getInstance();

            // Préparer la requête SQL pour récupérer l'utilisateur par son email
            $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, id_niveau
                    FROM utilisateurs
                    WHERE mail_utilisateur = :email";
            $stmt = $pdo->prepare($sql);

            // Lier le paramètre email et exécuter la requête
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si un utilisateur est trouvé, le retourner directement (sans vérification de mot de passe)
            if ($user) {
                return $user;
            } else {
                // Utilisateur non trouvé
                return false;
            }
        } catch (\PDOException $e) {
            // En cas d'erreur de base de données, enregistrer l'erreur et retourner false
            error_log("Erreur PDO lors de l'authentification de l'utilisateur (sans mot de passe) : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Récupère les informations d'un utilisateur par son ID.
     * @param int $id_utilisateur L'ID de l'utilisateur.
     * @return array|false Retourne un tableau associatif des données de l'utilisateur ou false si non trouvé.
     */
    public function getUserById(int $id_utilisateur)
    {
        try {
            $pdo = Connection::getInstance();
            $sql = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, id_niveau
                    FROM utilisateurs
                    WHERE id_utilisateur = :id_utilisateur";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur PDO lors de la récupération de l'utilisateur par ID : " . $e->getMessage());
            return false;
        }
    }
}