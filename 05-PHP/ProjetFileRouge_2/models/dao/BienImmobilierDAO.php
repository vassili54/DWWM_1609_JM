<?php
// models/dao/BienImmobilierDAO.php

// Incluez le fichier de connexion
require_once __DIR__ . '/Connection.php';

class BienImmobilierDAO
{
    /**
     * Récupère les biens immobiliers en appliquant des filtres optionnels.
     * @param int|null $departement_id L'ID du département à filtrer.
     * @param float|null $budget_max Le budget maximum.
     * @param int|null $nbr_pieces Le nombre de pièces.
     * @param int|null $categorie_id L'ID de la catégorie à filtrer. // <-- NOUVEAU PARAMÈTRE DANS LA DOC
     * @return array Tableau de biens immobiliers.
     */

    public function getAllBiens($departement_id = null, $budget_max = null, $nbr_pieces = null, $categorie_id = null)
    {
        try {
            $pdo = Connection::getInstance(); // <<< Utilise Connection::getInstance()

            $sql = "SELECT b.*, c.lib_categorie FROM biens_immobiliers b JOIN categories c ON b.id_categorie = c.id_categorie WHERE 1=1"; // WHERE 1=1 permet d'ajouter des conditions facilement (c.id_categorie=1)

            $params = [];

            // Ajouter les conditions si les filtres sont définis
            if ($departement_id !== null && $departement_id !== '') {
                $sql .= " AND b.num_departement = :departement_id";
                $params[':departement_id'] = $departement_id;
            }

            if ($budget_max !== null && $budget_max !== '') {
                $sql .= " AND b.prix_vente <= :budget_max"; // Utilisation de prix_vente
                $params[':budget_max'] = $budget_max;
            }

            if ($nbr_pieces !== null && $nbr_pieces !== '' && $nbr_pieces !== ' ') { // Ajouter ' ' pour la valeur par défaut du select
                $sql .= " AND b.nbr_pieces = :nbr_pieces";
                $params[':nbr_pieces'] = $nbr_pieces;
            }

            if ($categorie_id !== null && $categorie_id !== '') {
                $sql .= " AND b.id_categorie = :categorie_id";
                $params[':categorie_id'] = $categorie_id;
            }

            $sql .= " ORDER BY b.id DESC"; // Tri final

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params); // Exécuter la requête avec les paramètres liés

            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des biens avec filtres : " . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur 
        }
    }

    /**
     * Récupère tous les départements actifs depuis la base de données.
     * @return array Tableau d'objets ou de tableaux associatifs de départements.
     */
    public function getDepartements()
    {
        try {
            $pdo = Connection::getInstance();
            $stmt = $pdo->query("SELECT id_dep, nom_dep FROM departements WHERE dep_actif = 1 ORDER BY id_dep ASC");
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des départements : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère toutes les catégories de biens immobiliers depuis la base de données.
     * @return array Tableau d'objets ou de tableaux associatifs de catégories.
     */
    public function getCategories()
    {
        try {
            $pdo = Connection::getInstance();
            $stmt = $pdo->query("SELECT id_categorie, lib_categorie FROM categories ORDER BY lib_categorie ASC");
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des catégories : " . $e->getMessage());
            return [];
        }
    }
}
