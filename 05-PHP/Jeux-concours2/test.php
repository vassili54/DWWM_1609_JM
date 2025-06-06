<?php
require_once __DIR__.'/dao/Dbconnect.php';
require_once __DIR__.'/dao/CandidateRepository.php';
require_once __DIR__.'/dao/DepartementRepository.php';

class JeuConcoursTest {
    private $candidateRepo;
    private $departementRepo;
    private $pdo; // Ajout d'une propriété PDO pour l'accès direct à la DB pour les tests

    public function __construct() {
        $this->candidateRepo = new CandidateRepository();
        $this->departementRepo = new DepartementRepository();
        $this->pdo = Dbconnect::getInstance()->getPDO(); // Initialisation de PDO
    }

    public function runAllTests() {
        $this->testDbConnection();
        $this->testDepartementRepository();
        $this->testCandidateRepository();
    }

    private function testDbConnection() {
        echo "<h2>Test de connexion à la base de données</h2>";

        try {
            $db = Dbconnect::getInstance()->getPDO();
            echo "<p style='color:green'>✓ Connexion à la base de données réussie</p>";

            // Test requête simple
            $stmt = $db->query("SELECT 1");
            if ($stmt->fetchColumn() == 1) {
                echo "<p style='color:green'>✓ Test requête SQL réussi</p>";
            } else {
                echo "<p style='color:red'>✗ Test requête SQL échoué</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    private function testDepartementRepository() {
        echo "<h2>Test DepartementRepository</h2>";

        try {
            $departements = $this->departementRepo->getAllDepartements();

            if (!empty($departements)) {
                echo "<p style='color:green'>✓ Récupération des départements réussie (" . count($departements) . " départements)</p>";

                // Afficher les 5 premiers départements à titre d'exemple
                echo "<h3>Exemples de départements :</h3>";
                echo "<ul>";
                for ($i = 0; $i < min(5, count($departements)); $i++) {
                    echo "<li>" . htmlspecialchars($departements[$i]->id_dep) . " - " .
                                 htmlspecialchars($departements[$i]->Name) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p style='color:red'>✗ Aucun département trouvé</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    private function testCandidateRepository() {
        echo "<h2>Test CandidateRepository</h2>";

        $testEmail = 'test_' . uniqid() . '@example.com';
        $testPassword = 'Test1234!'; // Mot de passe en clair pour le test
        $testData = [
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email' => $testEmail,
            'password' => $testPassword, // Utilisation du mot de passe en clair
            'departement' => 75, // Paris
            'age' => 30
        ];

        // Test création candidat
        echo "<h3>Test createCandidate</h3>";
        try {
            $result = $this->candidateRepo->createCandidate(
                $testData['lastname'],
                $testData['firstname'],
                $testData['email'],
                $testData['password'],
                $testData['departement'],
                $testData['age']
            );

            if ($result) {
                echo "<p style='color:green'>✓ Création candidat réussie</p>";

                // AJOUT DU TEST DE VÉRIFICATION DIRECTE EN BASE DE DONNÉES
                $this->verifyCandidateInDb($testData['email'], $testData['password']);

                // Test recherche par âge
                $this->testSearchByAge($testData['age']);

                // Test authentification
                $this->testSignIn($testData['email'], $testData['password']);

                // Test recherche tous les candidats
                $this->testSearchAll();

                // Nettoyage
                $this->cleanupTestCandidate($testEmail);
            } else {
                echo "<p style='color:red'>✗ Création candidat échouée</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    /**
     * Nouvelle méthode pour vérifier directement en base de données si le candidat a été inséré.
     */
    private function verifyCandidateInDb(string $email, string $password) {
        echo "<h3>Vérification directe du candidat en base de données</h3>";
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM candidats WHERE mail_user = :email");
            $stmt->execute([':email' => $email]);
            $candidate = $stmt->fetch();

            if ($candidate) {
                echo "<p style='color:green'>✓ Candidat trouvé en base de données avec l'email : " . htmlspecialchars($email) . "</p>";

                // Vérifier les données clés
                if ($candidate->lastname_user === 'Doe' &&
                    $candidate->firstname_user === 'John' &&
                    $candidate->departement_user === 75 &&
                    $candidate->age_user === 30) {
                    echo "<p style='color:green'>✓ Données du candidat (nom, prénom, département, âge) correspondent</p>";
                } else {
                    echo "<p style='color:red'>✗ Certaines données du candidat ne correspondent pas</p>";
                }

                // Vérifier le mot de passe haché
                if (password_verify($password, $candidate->pass_user)) {
                    echo "<p style='color:green'>✓ Mot de passe haché correctement stocké et vérifié</p>";
                } else {
                    echo "<p style='color:red'>✗ Mot de passe haché ne correspond pas</p>";
                }

            } else {
                echo "<p style='color:red'>✗ Candidat avec l'email " . htmlspecialchars($email) . " NON trouvé en base de données après insertion.</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur lors de la vérification directe : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }


    private function testSearchByAge(int $age) {
        echo "<h3>Test searchByAge</h3>";

        try {
            $candidates = $this->candidateRepo->searchByAge($age);

            if (!empty($candidates)) {
                echo "<p style='color:green'>✓ Recherche par âge réussie (" . count($candidates) . " résultats)</p>";
            } else {
                echo "<p style='color:orange'>⚠ Recherche par âge réussie mais aucun résultat</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    private function testSignIn(string $email, string $password) {
        echo "<h3>Test signIn</h3>";

        try {
            // Test avec bonnes credentials
            $result = $this->candidateRepo->signIn($email, $password);
            echo $result
                ? "<p style='color:green'>✓ Authentification réussie avec bonnes credentials</p>"
                : "<p style='color:red'>✗ Authentification échouée avec bonnes credentials</p>";

            // Test avec mauvais mot de passe
            $result = $this->candidateRepo->signIn($email, 'wrongpassword');
            echo !$result
                ? "<p style='color:green'>✓ Authentification échouée avec mauvais mot de passe (comportement attendu)</p>"
                : "<p style='color:red'>✗ Authentification réussie avec mauvais mot de passe</p>";
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    private function testSearchAll() {
        echo "<h3>Test searchAll</h3>";

        try {
            $candidates = $this->candidateRepo->searchAll();

            if (!empty($candidates)) {
                echo "<p style='color:green'>✓ Recherche tous les candidats réussie (" . count($candidates) . " résultats)</p>";
            } else {
                echo "<p style='color:orange'>⚠ Recherche tous les candidats réussie mais aucun résultat</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    private function cleanupTestCandidate(string $email) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM candidats WHERE mail_user = :email");
            $stmt->execute([':email' => $email]);
            echo "<p style='color:green'>✓ Nettoyage du candidat de test effectué</p>";
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Erreur lors du nettoyage : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}

// Exécution des tests
echo "<!DOCTYPE html><html><head><title>Tests Jeu Concours</title><style>body{font-family:Arial,sans-serif;padding:20px}</style></head><body>";
echo "<h1>Tests du système Jeu Concours</h1>";

$test = new JeuConcoursTest();
$test->runAllTests();

echo "</body></html>";