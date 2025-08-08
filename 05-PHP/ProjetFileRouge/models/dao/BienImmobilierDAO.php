<?php
// models/dao/BienImmobilierDAO.php

require_once __DIR__ . '/Connection.php';

class BienImmobilierDAO
{
    /**
     * Récupère tous les biens immobiliers ou les biens filtrés.
     * @param int|null $departement_id L'ID du département (num_departement).
     * @param float|null $budget_max Le prix de vente maximum (prix_vente).
     * @param int|null $nbr_pieces Le nombre de pièces (nbr_pieces).
     * @param int|null $categorie_id L'ID de la catégorie (id_categorie).
     * @param int|null $id_utilisateur_commercial L'ID de l'utilisateur commercial pour filtrer ses biens.
     * @return array Tableau de biens immobiliers.
     */
    public function getAllBiens($departement_id = null, $budget_max = null, $nbr_pieces = null, $categorie_id = null, $id_utilisateur_commercial = null): array
    {
        try {
            $pdo = Connection::getInstance();

            $sql = "SELECT b.*, c.lib_categorie, i.chemin_image AS nom_fichier_photo
                    FROM biens_immobiliers b
                    JOIN categories c ON b.id_categorie = c.id_categorie
                    LEFT JOIN association_img ai ON b.id = ai.id AND ai.img_ppal = 1
                    LEFT JOIN images i ON ai.id_image = i.id_image
                    WHERE 1=1";

            $params = [];

            if ($departement_id !== null && $departement_id !== '') {
                $sql .= " AND b.num_departement = :departement_id";
                $params[':departement_id'] = $departement_id;
            }

            if ($budget_max !== null && $budget_max !== '') {
                $sql .= " AND b.prix_vente <= :budget_max";
                $params[':budget_max'] = $budget_max;
            }

            if ($nbr_pieces !== null && $nbr_pieces !== '' && $nbr_pieces !== ' ') {
                $sql .= " AND b.nbr_pieces = :nbr_pieces";
                $params[':nbr_pieces'] = $nbr_pieces;
            }

            if ($categorie_id !== null && $categorie_id !== '') {
                $sql .= " AND b.id_categorie = :categorie_id";
                $params[':categorie_id'] = $categorie_id;
            }

            // NOUVEAU : Filtrer par utilisateur commercial si un ID est fourni
            if ($id_utilisateur_commercial !== null) {
                $sql .= " AND b.id_utilisateur_commercial = :id_utilisateur_commercial";
                $params[':id_utilisateur_commercial'] = $id_utilisateur_commercial;
            }

            $sql .= " ORDER BY b.id DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des biens avec filtres (DAO): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère un bien immobilier par son ID, incluant les informations de catégorie et l'image principale.
     * @param int $id L'ID du bien immobilier.
     * @return array|false Tableau associatif du bien ou false si non trouvé.
     */
    public function getBienById(int $id)
    {
        try {
            $pdo = Connection::getInstance();

            $sql = "SELECT b.*, c.lib_categorie, i.chemin_image AS nom_fichier_photo
                    FROM biens_immobiliers b
                    JOIN categories c ON b.id_categorie = c.id_categorie
                    LEFT JOIN association_img ai ON b.id = ai.id AND ai.img_ppal = 1
                    LEFT JOIN images i ON ai.id_image = i.id_image
                    WHERE b.id = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération du bien par ID (DAO): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Met à jour un bien immobilier existant.
     * @param array $data Tableau associatif des données du bien. Doit contenir 'id' et les autres champs.
     * @return bool Vrai si la mise à jour est réussie, faux sinon.
     */
    public function updateBien(array $data): bool
    {
        try {
            $pdo = Connection::getInstance();

            $sql = "UPDATE biens_immobiliers SET
                        titre = :titre,
                        nbr_pieces = :nbr_pieces,
                        surface = :surface,
                        prix_vente = :prix_vente,
                        description = :description,
                        ges = :ges,
                        classe_eco = :classe_eco,
                        meuble = :meuble,
                        localisation = :localisation,
                        num_departement = :num_departement,
                        ville = :ville,
                        charges_annuelles = :charges_annuelles,
                        id_utilisateur_commercial = :id_utilisateur_commercial,
                        id_categorie = :id_categorie,
                        id_proprietaire = :id_proprietaire
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':titre', $data['titre'], PDO::PARAM_STR);
            $stmt->bindParam(':nbr_pieces', $data['nbr_pieces'], PDO::PARAM_INT);
            $stmt->bindParam(':surface', $data['surface'], PDO::PARAM_STR);
            $stmt->bindParam(':prix_vente', $data['prix_vente'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':ges', $data['ges'], PDO::PARAM_STR);
            $stmt->bindParam(':classe_eco', $data['classe_eco'], PDO::PARAM_STR);
            $stmt->bindParam(':meuble', $data['meuble'], PDO::PARAM_INT);
            $stmt->bindParam(':localisation', $data['localisation'], PDO::PARAM_STR);
            $stmt->bindParam(':num_departement', $data['num_departement'], PDO::PARAM_INT);
            $stmt->bindParam(':ville', $data['ville'], PDO::PARAM_STR);
            $stmt->bindParam(':charges_annuelles', $data['charges_annuelles'], PDO::PARAM_STR);
            $stmt->bindParam(':id_utilisateur_commercial', $data['id_utilisateur_commercial'], PDO::PARAM_INT);
            $stmt->bindParam(':id_categorie', $data['id_categorie'], PDO::PARAM_INT);
            $stmt->bindParam(':id_proprietaire', $data['id_proprietaire'], PDO::PARAM_INT);

            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);

            return $stmt->execute();

        } catch (\PDOException $e) {
            error_log("Erreur PDO lors de la mise à jour du bien immobilier (ID: " . ($data['id'] ?? 'N/A') . ") : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Récupère tous les départements actifs.
     * @return array Tableau des départements.
     */
    public function getDepartements(): array
    {
        try {
            $pdo = Connection::getInstance();
            $stmt = $pdo->query("SELECT id_dep, nom_dep FROM departements WHERE dep_actif = 1 ORDER BY nom_dep ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des départements (DAO): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère toutes les catégories de biens.
     * @return array Tableau des catégories.
     */
    public function getCategories(): array
    {
        try {
            $pdo = Connection::getInstance();
            $stmt = $pdo->query("SELECT id_categorie, lib_categorie FROM categories ORDER BY lib_categorie ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des catégories (DAO): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère tous les utilisateurs commerciaux.
     * @return array Tableau des utilisateurs.
     */
    public function getUtilisateursCommerciaux(): array
    {
        try {
            $pdo = Connection::getInstance();
            $stmt = $pdo->query("SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur FROM utilisateurs WHERE id_niveau = 2 ORDER BY nom_utilisateur ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des utilisateurs commerciaux (DAO): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère tous les propriétaires.
     * @return array Tableau des propriétaires.
     */
    public function getProprietaires(): array
    {
        try {
            $pdo = Connection::getInstance();
            $stmt = $pdo->query("SELECT id_proprietaire, nom, prenom FROM proprietaires ORDER BY nom ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des propriétaires (DAO): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Insère une nouvelle image et la retourne (ou false en cas d'erreur).
     * @param string $chemin_image Nom du fichier image (ex: photo123.jpg).
     * @param string $bien_titre Le titre du bien, à utiliser pour titre_image et texte_alternatif.
     * @param string $extension Extension du fichier.
     * @return int|false L'ID de la nouvelle image ou false.
     */
    public function insertImage(string $chemin_image, string $bien_titre, string $extension)
    {
        try {
            $pdo = Connection::getInstance();
            $sql = "INSERT INTO images (chemin_image, titre_image, texte_alternatif, extension) VALUES (:chemin_image, :titre_image, :texte_alternatif, :extension)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':chemin_image', $chemin_image);
            $stmt->bindParam(':titre_image', $bien_titre);
            $stmt->bindParam(':texte_alternatif', $bien_titre);
            $stmt->bindParam(':extension', $extension);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Erreur lors de l'insertion de l'image (DAO): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Associe une image principale à un bien immobilier.
     * Met à jour l'image principale existante ou en insère une nouvelle.
     * @param int $bien_id L'ID du bien immobilier.
     * @param int $image_id L'ID de l'image.
     * @return bool Vrai si l'opération réussit, faux sinon.
     */
    public function updateOrCreateMainImageAssociation(int $bien_id, int $image_id): bool
    {
        try {
            $pdo = Connection::getInstance();

            // D'abord, on supprime l'ancienne image principale si elle existe
            $sql_delete_old = "DELETE FROM association_img WHERE id = :bien_id AND img_ppal = 1";
            $stmt_delete = $pdo->prepare($sql_delete_old);
            $stmt_delete->bindParam(':bien_id', $bien_id, PDO::PARAM_INT);
            $stmt_delete->execute();

            // Ensuite, on insère la nouvelle image principale
            $sql_insert_new = "INSERT INTO association_img (id, id_image, img_ppal) VALUES (:bien_id, :image_id, 1)";
            $stmt_insert = $pdo->prepare($sql_insert_new);
            $stmt_insert->bindParam(':bien_id', $bien_id, PDO::PARAM_INT);
            $stmt_insert->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            return $stmt_insert->execute();

        } catch (\PDOException $e) {
            error_log("Erreur lors de la mise à jour/création de l'association d'image principale (DAO): " . $e->getMessage());
            return false;
        }
    }
}