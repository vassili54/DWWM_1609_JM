<?php
/**
 * Classe Dbconnect
 *
 * Implémente le pattern Singleton pour assurer une seule instance de connexion PDO
 * à la base de données tout au long de l'application.
 */
class Dbconnect {
    // Variable statique pour stocker l'unique instance de la classe Dbconnect
    private static $instance = null;
    // L'objet PDO pour la connexion à la base de données
    private $pdo;

    /**
     * Constructeur privé.
     * Empêche l'instanciation directe de la classe depuis l'extérieur.
     * Établit la connexion PDO.
     */
    private function __construct() {
        try {
            // Initialisation de l'objet PDO avec les informations de connexion
            // 'mysql:host=localhost;dbname=festival;charset=utf8mb4' : DSN (Data Source Name)
            //   - host: l'hôte de la base de données (ici, le même serveur)
            //   - dbname: le nom de la base de données
            // 'root' : Nom d'utilisateur de la base de données (À CHANGER POUR LA PRODUCTION !)
            // '' : Mot de passe de la base de données (À CHANGER POUR LA PRODUCTION !)
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=festival;charset=utf8mb4',
                'root', // Nom d'utilisateur, à remplacer par un utilisateur dédié en production
                '',     // Mot de passe, à remplacer par un mot de passe fort en production
                [
                    // Options de configuration PDO
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Configure PDO pour lancer des exceptions en cas d'erreur SQL
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Définit le mode de récupération par défaut des résultats en objets anonymes
                    PDO::ATTR_EMULATE_PREPARES => false, // Désactive l'émulation des requêtes préparées (meilleure sécurité et performance)
                    PDO::ATTR_STRINGIFY_FETCHES => false // Empêche PDO de convertir les valeurs numériques en chaînes lors de la récupération
                ]
            );
        } catch (PDOException $e) {
            // Capture les erreurs de connexion à la base de données
            // Lance une RuntimeException avec le message d'erreur pour une gestion plus haut dans l'application
            throw new RuntimeException('Erreur de connexion à la base de données: ' . $e->getMessage());
        }
    }

    /**
     * Retourne l'instance unique de la classe Dbconnect (pattern Singleton).
     * Crée l'instance si elle n'existe pas déjà.
     */
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self(); // Crée une nouvelle instance si aucune n'existe
        }
        return self::$instance; // Retourne l'instance existante ou nouvellement créée
    }

    /**
     * Retourne l'objet PDO pour interagir avec la base de données.
     */
    public function getPDO(): PDO {
        return $this->pdo;
    }

    /**
     * Empêche le clonage de l'instance Singleton.
     */
    private function __clone() {}

    /**
     * Empêche la désérialisation de l'instance Singleton,
     * garantissant son unicité.
     */
    public function __wakeup() {
        throw new RuntimeException("Cannot unserialize singleton");
    }
}
?>