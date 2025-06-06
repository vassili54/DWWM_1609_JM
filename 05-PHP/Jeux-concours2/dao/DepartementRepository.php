<?php
// Inclusion du fichier de connexion à la base de données
require_once __DIR__.'/Dbconnect.php';

/**
 * Classe DepartementRepository
 *
 * Gère les opérations de récupération des départements depuis la base de données.
 */
class DepartementRepository {
    private PDO $pdo; // Propriété pour stocker l'objet PDO

    /**
     * Constructeur de la classe.
     * Récupère l'instance PDO via le Singleton Dbconnect.
     */
    public function __construct() {
        $this->pdo = Dbconnect::getInstance()->getPDO();
    }

    /**
     * Récupère tous les départements de la base de données, triés par nom.
     *
     * @return array Tableau d'objets départements (ou vide si aucun).
     * @throws RuntimeException En cas d'erreur de récupération.
     */
    public function getAllDepartements(): array {
        try {
            // Exécute une requête simple pour obtenir tous les départements
            $stmt = $this->pdo->query("SELECT id_dep, Name FROM departements ORDER BY Name");
            return $stmt->fetchAll() ?: []; // Récupère tous les résultats, ou un tableau vide
        } catch (PDOException $e) {
            error_log('Erreur getAllDepartements: '.$e->getMessage()); // Journalise l'erreur
            throw new RuntimeException("Erreur lors de la récupération des départements"); // Lance une exception générique
        }
    }
}
?>