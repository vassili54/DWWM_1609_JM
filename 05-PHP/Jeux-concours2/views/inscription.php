<?php
// Inclusion des fichiers nécessaires : connexion DB, et les classes Repository
require_once __DIR__ . '/../dao/Dbconnect.php';
require_once __DIR__ . '/../dao/CandidateRepository.php';
require_once __DIR__ . '/../dao/DepartementRepository.php';

/**
 * Fonction de validation des données du formulaire.
 * Vérifie la présence des champs, les formats (email), la force du mot de passe et la cohérence.
 *
 * @param array $data Tableau associatif des données du formulaire.
 * @return array Tableau des messages d'erreurs (vide si aucune erreur).
 */
function validateForm(array $data): array
{
    $errors = []; // Initialise un tableau vide pour stocker les erreurs

    // Vérifications de base pour la présence et le format des données
    if (empty($data['lastname'])) $errors[] = "Le nom est requis";
    if (empty($data['firstname'])) $errors[] = "Le prénom est requis";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide";
    // Vérifications de la force du mot de passe
    if (strlen($data['password']) < 8) $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    if (!preg_match('/[A-Z]/', $data['password'])) $errors[] = "Le mot de passe doit contenir au moins une majuscule";
    if (!preg_match('/[0-9]/', $data['password'])) $errors[] = "Le mot de passe doit contenir au moins un chiffre";
    if ($data['password'] !== $data['password_confirm']) $errors[] = "Les mots de passe ne correspondent pas"; // Vérification de la confirmation
    // Vérification de la validité du département et de l'âge
    if ($data['departement'] <= 0) $errors[] = "Département invalide"; // Assure qu'un département a été sélectionné
    if ($data['age'] < 18 || $data['age'] > 120) $errors[] = "L'âge doit être compris entre 18 et 120 ans";

    return $errors; // Retourne le tableau des erreurs
}

// Bloc principal de gestion du formulaire et de la logique métier
try {
    // Instanciation des classes Repository pour interagir avec la base de données
    $departementRepo = new DepartementRepository();
    $candidateRepo = new CandidateRepository();
    // Récupération de tous les départements pour le sélecteur du formulaire
    $departements = $departementRepo->getAllDepartements();

    $message = ''; // Variable pour stocker les messages de succès ou d'erreur
    // Initialisation des données du formulaire pour pré-remplir en cas d'erreur
    $formData = [
        'lastname' => '',
        'firstname' => '',
        'email' => '',
        'departement' => '',
        'age' => ''
    ];

    // Vérifie si le formulaire a été soumis en méthode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupère et nettoie (trim) les données du formulaire
        $formData = [
            'lastname' => trim($_POST['lastname'] ?? ''),
            'firstname' => trim($_POST['firstname'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirm' => $_POST['password_confirm'] ?? '',
            'departement' => (int)($_POST['departement'] ?? 0), // Caste en entier
            'age' => (int)($_POST['age'] ?? 0) // Caste en entier
        ];

        // Valide les données soumises
        $errors = validateForm($formData);

        // Si aucune erreur de validation n'est trouvée
        if (empty($errors)) {
            // Tente de créer le candidat via le CandidateRepository
            if ($candidateRepo->createCandidate(
                $formData['lastname'],
                $formData['firstname'],
                $formData['email'],
                $formData['password'],
                $formData['departement'],
                $formData['age']
            )) {
                $message = '<div class="success">Inscription réussie !</div>';
                // Réinitialise le formulaire après une inscription réussie
                $formData = [
                    'lastname' => '',
                    'firstname' => '',
                    'email' => '',
                    'departement' => '',
                    'age' => ''
                ];
            } else {
                // Si la création du candidat échoue (par ex. email déjà utilisé), un message d'erreur est affiché
                $message = '<div class="error">Erreur lors de l\'inscription</div>';
            }
        } else {
            // Si des erreurs de validation existent, les affiche toutes
            $message = '<div class="error">' . implode('<br>', $errors) . '</div>';
        }
    }
} catch (Exception $e) {
    // Capture toute autre exception non gérée (par ex. problème de connexion DB depuis Dbconnect)
    $message = '<div class="error">Une erreur est survenue: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Jeu-Concours</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- <div class="container"> Supprimé -->
        <h1>Inscription candidat<br>Jeu-Concours</h1>

        <?= $message ?>

        <form method="POST" novalidate>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required
                    value="<?= htmlspecialchars($formData['lastname']) ?>">
            </div>

            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" required
                    value="<?= htmlspecialchars($formData['firstname']) ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                    value="<?= htmlspecialchars($formData['email']) ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-input-container"> <input type="password" id="password" name="password" class="form-control" required
                        oninput="checkPasswordStrength(this.value)">
                    <span class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i> </span>
                </div>

                <div class="mt-2">
                    <div class="progress" style="height: 5px;">
                        <div id="password-strength-bar" class="progress-bar" role="progressbar"></div>
                    </div>
                    <small id="password-feedback" class="form-text"></small>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirmation du mot de passe</label>
                <div class="password-input-container"> <input type="password" id="password_confirm" name="password_confirm" class="form-control" required
                        oninput="checkPasswordMatch()">
                    <span class="password-toggle" id="toggleConfirmPassword">
                        <i class="fas fa-eye"></i> </span>
                </div>
                <small id="password-match-feedback" class="form-text"></small>
            </div>

            <div class="form-group">
                <label for="departement">Département de votre domicile principal</label>
                <select id="departement" name="departement" required>
                    <option value="">Choisir un Département</option>
                    <?php foreach ($departements as $dep): // Boucle pour afficher les options de département 
                    ?>
                        <option value="<?= $dep->id_dep ?>"
                            <?= ($formData['departement'] == $dep->id_dep) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dep->Name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="age">Votre âge</label>
                <input type="number" id="age" name="age" min="18" max="120" required
                    value="<?= htmlspecialchars($formData['age']) ?>">
            </div>

            <button type="submit">Valider</button>
        </form>
        <p class="mt-3 text-center">Déjà inscrit ? <a href="index.php?page=connexion">Connectez-vous ici</a>.</p>
    <!-- </div> Supprimé -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirm');
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthFeedback = document.getElementById('password-feedback');
            const matchFeedback = document.getElementById('password-match-feedback');

            passwordInput.addEventListener('input', updatePasswordStrength);
            confirmInput.addEventListener('input', checkPasswordMatch);

            function updatePasswordStrength() {
                const password = passwordInput.value;
                let score = 0;

                // Critères
                if (password.length >= 8) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^A-Za-z0-9]/.test(password)) score++;

                // Mise à jour visuelle
                updateStrengthIndicator(score, password.length);
            }

            function updateStrengthIndicator(score, length) {
                // Reset
                strengthBar.style.width = '0%';
                // Supprime toutes les classes bg-* existantes pour éviter les conflits
                strengthBar.classList.remove('bg-danger', 'bg-warning', 'bg-info', 'bg-success');
                strengthFeedback.textContent = ''; // Réinitialise le texte
                strengthFeedback.className = 'form-text'; // Réinitialise les classes du feedback

                if (length === 0) {
                    return;
                }

                // Niveaux de force
                const levels = [{
                        class: 'bg-danger',
                        width: '25%',
                        text: 'Faible'
                    },
                    {
                        class: 'bg-danger', // Répété pour un score de 1 (très faible)
                        width: '25%',
                        text: 'Faible'
                    },
                    {
                        class: 'bg-warning',
                        width: '50%',
                        text: 'Moyen'
                    },
                    {
                        class: 'bg-info',
                        width: '75%',
                        text: 'Bon'
                    },
                    {
                        class: 'bg-success',
                        width: '100%',
                        text: 'Fort'
                    }
                ];

                // Détermine le niveau en fonction du score et de la longueur
                // Si la longueur est < 8, c'est toujours "Faible" (level 0 ou 1)
                // Sinon, score + 1 pour mapper (0,1,2,3,4) à (1,2,3,4,5) index, clamp à 4
                const level = length < 8 ? 0 : Math.min(score + 1, 4);
                // Assurez-vous que l'index ne dépasse pas la taille du tableau levels

                // Appliquer le style et le texte
                strengthBar.classList.add(levels[level].class); // Ajoute la classe bg-*
                strengthBar.style.width = levels[level].width;
                strengthFeedback.textContent = levels[level].text;
                // Correctement définir la classe du feedback textuel
                strengthFeedback.classList.add(`text-${levels[level].class.replace('bg-', '')}`);
            }

            function checkPasswordMatch() {
                if (!passwordInput.value || !confirmInput.value) {
                    matchFeedback.textContent = '';
                    return;
                }

                if (passwordInput.value === confirmInput.value) {
                    matchFeedback.textContent = '✓ Correspondance';
                    matchFeedback.className = 'form-text text-success';
                } else {
                    matchFeedback.textContent = '✗ Non identiques';
                    matchFeedback.className = 'form-text text-danger';
                }
            }
            
            // NOUVEAU CODE POUR L'OEIL DE MOT DE PASSE
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

            togglePassword.addEventListener('click', function() {
                toggleVisibility(passwordInput, togglePassword.querySelector('i'));
            });

            toggleConfirmPassword.addEventListener('click', function() {
                toggleVisibility(confirmInput, toggleConfirmPassword.querySelector('i'));
            });

            function toggleVisibility(inputElement, iconElement) {
                // Bascule le type de l'input
                const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
                inputElement.setAttribute('type', type);

                // Bascule l'icône de l'œil
                iconElement.classList.toggle('fa-eye');
                iconElement.classList.toggle('fa-eye-slash');
            }
        });
    </script>
</body>

</html>