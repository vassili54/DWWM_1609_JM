<?php
// Inclusion du fichier de connexion à la base de données
require_once __DIR__.'/Dbconnect.php';

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
     * @return object|false L'objet candidat si l'authentification est réussie, faux sinon.
     * @throws RuntimeException En cas d'erreur d'authentification.
     */
    public function signIn(string $email, string $password): object|false {
        try {
            // Récupère l'utilisateur pour l'email donné
            $stmt = $this->pdo->prepare("SELECT * FROM candidats WHERE mail_user = :email");
            $stmt->execute([':email' => filter_var($email, FILTER_SANITIZE_EMAIL)]);
            $user = $stmt->fetch(); // Récupère la première ligne (si elle existe)

            // Vérifie si un utilisateur a été trouvé ET si le mot de passe correspond au haché
            if ($user && password_verify($password, $user->pass_user)) {
                return $user; // Retourne l'objet utilisateur complet
            }
            return false; // Retourne faux si l'authentification échoue
        } catch (PDOException $e) {
            error_log('Erreur signIn: '.$e->getMessage());
            throw new RuntimeException("Erreur lors de l'authentification");
        }
    }

    /**
     * Récupère un candidat par son ID.
     *
     * @param int $id L'ID du candidat.
     * @return object|false L'objet candidat si trouvé, faux sinon.
     */
    public function findById(int $id): object|false {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM candidats WHERE id_user = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log('Erreur findById: '.$e->getMessage());
            throw new RuntimeException("Erreur lors de la récupération du candidat par ID");
        }
    }
/**
     * Met à jour les informations d'un candidat.
     *
     * @param int $id L'ID du candidat à mettre à jour.
     * @param array $data Tableau associatif des données à mettre à jour.
     *                    Peut inclure : lastname, firstname, email, departement, age.
     *                    Le mot de passe n'est plus géré ici.
     * @return bool Vrai si la mise à jour est réussie, faux sinon.
     * @throws RuntimeException En cas d'erreur.
     */
    public function updateCandidate(int $id, array $data): bool {
        // Construire la requête SQL dynamiquement en fonction des données fournies
        $fields = [];
        $params = [':id_user' => $id];

        if (!empty($data['lastname_user'])) {
            $fields[] = "lastname_user = :lastname_user";
            $params[':lastname_user'] = $this->sanitizeInput($data['lastname_user']);
        }
        if (!empty($data['firstname_user'])) {
            $fields[] = "firstname_user = :firstname_user";
            $params[':firstname_user'] = $this->sanitizeInput($data['firstname_user']);
        }
        if (!empty($data['mail_user'])) {
            // Vérifier si le nouvel email n'est pas déjà utilisé par un AUTRE utilisateur
            $stmtCheckEmail = $this->pdo->prepare("SELECT id_user FROM candidats WHERE mail_user = :mail_user AND id_user != :id_user");
            $stmtCheckEmail->execute([':mail_user' => $data['mail_user'], ':id_user' => $id]);
            if ($stmtCheckEmail->fetch()) {
                throw new RuntimeException("Cet email est déjà utilisé par un autre compte.");
            }
            $fields[] = "mail_user = :mail_user";
            $params[':mail_user'] = filter_var($data['mail_user'], FILTER_SANITIZE_EMAIL);
        }
        if (!empty($data['departement_user'])) {
            $fields[] = "departement_user = :departement_user";
            $params[':departement_user'] = (int)$data['departement_user'];
        }
        if (!empty($data['age_user'])) {
            $fields[] = "age_user = :age_user";
            $params[':age_user'] = (int)$data['age_user'];
        }

        // La gestion de la mise à jour du mot de passe est supprimée
        // if ($newPassword !== null && !empty(trim($newPassword))) {
        //     $fields[] = "pass_user = :pass_user";
        //     $params[':pass_user'] = password_hash($newPassword, PASSWORD_ARGON2ID);
        // }

        if (empty($fields)) {
            return true; // Aucune donnée à mettre à jour
        }

        $sql = "UPDATE candidats SET " . implode(', ', $fields) . " WHERE id_user = :id_user";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log('Erreur updateCandidate: ' . $e->getMessage());
            throw new RuntimeException("Erreur lors de la mise à jour du candidat.");
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