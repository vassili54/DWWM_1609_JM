<?php
// Inclusion du fichier de connexion à la base de données
require_once __DIR__.'/../Dbconnect.php';

/**
 * Classe CandidateRepository
 *
 * Gère toutes les opérations de persistance (CRUD) pour les candidats
 * dans la base de données.
 * Utilise PDO pour des interactions sécurisées avec la base de données.
 */
class CandidateRepository {
    private PDO $pdo; // Propriété pour stocker l'objet PDO

    /**
     * Constructeur de la classe.
     * Récupère l'instance PDO via le Singleton Dbconnect.
     */
    public function __construct() {
        $this->pdo = Dbconnect::getInstance()->getPDO();
    }

    /**
     * Récupère tous les candidats de la base de données.
     *
     * @return array Tableau d'objets (ou vide si aucun candidat).
     * @throws RuntimeException En cas d'erreur de récupération.
     */
    public function searchAll(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM candidats"); // Exécute une requête simple
            return $stmt->fetchAll() ?: []; // Récupère tous les résultats, ou un tableau vide si aucun
        } catch (PDOException $e) {
            error_log('Erreur searchAll: '.$e->getMessage()); // Journalise l'erreur
            throw new RuntimeException("Erreur lors de la récupération des candidats"); // Lance une exception générique pour l'utilisateur
        }
    }

    /**
     * Crée un nouveau candidat dans la base de données.
     * Hache le mot de passe et vérifie l'unicité de l'email.
     *
     * @param string $lastname Nom de famille.
     * @param string $firstname Prénom.
     * @param string $email Adresse email.
     * @param string $password Mot de passe en clair.
     * @param int $departement ID du département.
     * @param int $age Âge.
     * @return bool Vrai si l'insertion est réussie, faux sinon.
     * @throws RuntimeException En cas d'email déjà utilisé ou d'erreur d'insertion.
     */
    public function createCandidate(
        string $lastname,
        string $firstname,
        string $email,
        string $password,
        int $departement,
        int $age
    ): bool {
        try {
            // Vérifie si l'email existe déjà avant d'insérer
            if ($this->emailExists($email)) {
                throw new RuntimeException("Cet email est déjà utilisé");
            }

            // Hache le mot de passe en utilisant l'algorithme fort Argon2ID
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

            // Prépare la requête INSERT pour prévenir les injections SQL
            $stmt = $this->pdo->prepare(
                "INSERT INTO candidats
                (lastname_user, firstname_user, mail_user, pass_user, departement_user, age_user)
                VALUES (:lastname, :firstname, :email, :password, :departement, :age)"
            );

            // Exécute la requête en liant les valeurs aux paramètres nommés
            return $stmt->execute([
                ':lastname' => $this->sanitizeInput($lastname), // Nettoyage du nom
                ':firstname' => $this->sanitizeInput($firstname), // Nettoyage du prénom
                ':email' => filter_var($email, FILTER_SANITIZE_EMAIL), // Nettoyage de l'email
                ':password' => $hashedPassword, // Mot de passe haché
                ':departement' => $departement,
                ':age' => $age
            ]);
        } catch (PDOException $e) {
            error_log('Erreur createCandidate: '.$e->getMessage()); // Journalise l'erreur de base de données
            throw new RuntimeException("Erreur lors de la création du candidat"); // Lance une exception générique
        }
    }

    /**
     * Recherche les candidats par âge.
     *
     * @param int $age L'âge à rechercher.
     * @return array Tableau d'objets candidats (ou vide si aucun).
     * @throws RuntimeException En cas d'erreur de recherche.
     */
    public function searchByAge(int $age): array {
        try {
            // Prépare la requête avec un paramètre pour l'âge
            $stmt = $this->pdo->prepare("SELECT * FROM candidats WHERE age_user = :age");
            $stmt->execute([':age' => $age]); // Exécute la requête
            return $stmt->fetchAll() ?: []; // Récupère les résultats
        } catch (PDOException $e) {
            error_log('Erreur searchByAge: '.$e->getMessage());
            throw new RuntimeException("Erreur lors de la recherche par âge");
        }
    }

    /**
     * Tente de connecter un utilisateur.
     * Vérifie le mot de passe fourni avec le mot de passe haché stocké.
     *
     * @param string $email L'email de l'utilisateur.
     * @param string $password Le mot de passe en clair fourni par l'utilisateur.
     * @return bool Vrai si l'authentification est réussie, faux sinon.
     * @throws RuntimeException En cas d'erreur d'authentification.
     */
    public function signIn(string $email, string $password): bool {
        try {
            // Récupère uniquement le mot de passe haché pour l'email donné
            $stmt = $this->pdo->prepare("SELECT pass_user FROM candidats WHERE mail_user = :email");
            $stmt->execute([':email' => filter_var($email, FILTER_SANITIZE_EMAIL)]);
            $result = $stmt->fetch(); // Récupère la première ligne (si elle existe)

            // Vérifie si un résultat a été trouvé ET si le mot de passe correspond au haché
            return $result && password_verify($password, $result->pass_user);
        } catch (PDOException $e) {
            error_log('Erreur signIn: '.$e->getMessage());
            throw new RuntimeException("Erreur lors de l'authentification");
        }
    }

    /**
     * Vérifie si un email existe déjà dans la base de données.
     *
     * @param string $email L'email à vérifier.
     * @return bool Vrai si l'email existe, faux sinon.
     */
    private function emailExists(string $email): bool {
        // Compte le nombre de lignes avec l'email donné
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM candidats WHERE mail_user = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0; // Retourne vrai si le compte est supérieur à 0
    }

    /**
     * Nettoie une chaîne de caractères pour l'insertion ou l'affichage.
     * Supprime les balises HTML, les espaces en début/fin et encode les caractères spéciaux.
     *
     * @param string $input La chaîne à nettoyer.
     * @return string La chaîne nettoyée.
     */
    private function sanitizeInput(string $input): string {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }
}