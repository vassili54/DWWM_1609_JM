<?php


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=connexion');
    exit;
}

require_once __DIR__ . '/../dao/Dbconnect.php';
require_once __DIR__ . '/../dao/CandidateRepository.php';
require_once __DIR__ . '/../dao/DepartementRepository.php';

$message = '';
$candidateRepo = new CandidateRepository();
$departementRepo = new DepartementRepository();

// Récupérer les informations actuelles du candidat
$currentCandidate = $candidateRepo->findById($_SESSION['user_id']);
if (!$currentCandidate) {
    session_destroy();
    header('Location: index.php?page=connexion&error=user_not_found');
    exit;
}

// Récupérer la liste des départements pour la liste déroulante
$departements = $departementRepo->getAllDepartements();

// Initialiser formData avec les données actuelles
$formData = [
    'lastname' => $currentCandidate->lastname_user,
    'firstname' => $currentCandidate->firstname_user,
    'email' => $currentCandidate->mail_user,
    'departement' => $currentCandidate->departement_user,
    'age' => $currentCandidate->age_user,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [
        'lastname_user' => trim($_POST['lastname'] ?? ''),
        'firstname_user' => trim($_POST['firstname'] ?? ''),
        'mail_user' => trim($_POST['email'] ?? ''),
        'departement_user' => (int)($_POST['departement'] ?? 0),
        'age_user' => (int)($_POST['age'] ?? 0)
    ];
    // $newPassword = $_POST['password'] ?? null; // Supprimé
    // $passwordConfirm = $_POST['password_confirm'] ?? null; // Supprimé

    // Validation (similaire à l'inscription, mais adaptée)
    $errors = [];
    if (empty($updateData['lastname_user'])) $errors[] = "Le nom est requis";
    if (empty($updateData['firstname_user'])) $errors[] = "Le prénom est requis";
    if (!filter_var($updateData['mail_user'], FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide";
    if ($updateData['departement_user'] <= 0) $errors[] = "Département invalide";
    if ($updateData['age_user'] < 18 || $updateData['age_user'] > 120) $errors[] = "L'âge doit être compris entre 18 et 120 ans";

    // La validation du mot de passe est supprimée

    if (empty($errors)) {
        try {
            // Appel à updateCandidate sans le paramètre de mot de passe
            if ($candidateRepo->updateCandidate($_SESSION['user_id'], $updateData)) {
                $message = '<div class="success">Profil mis à jour avec succès !</div>';
                // Re-récupérer les données pour afficher les infos à jour
                $currentCandidate = $candidateRepo->findById($_SESSION['user_id']);
                $formData = [
                    'lastname' => $currentCandidate->lastname_user,
                    'firstname' => $currentCandidate->firstname_user,
                    'email' => $currentCandidate->mail_user,
                    'departement' => $currentCandidate->departement_user,
                    'age' => $currentCandidate->age_user,
                ];
            } else {
                $message = '<div class="error">Erreur lors de la mise à jour du profil.</div>';
            }
        } catch (RuntimeException $e) {
            $message = '<div class="error">' . htmlspecialchars($e->getMessage()) . '</div>';
        } catch (Exception $e) {
            $message = '<div class="error">Une erreur inattendue est survenue.</div>';
        }
    } else {
        $message = '<div class="error">' . implode('<br>', $errors) . '</div>';
        // Conserver les données soumises en cas d'erreur pour ne pas tout perdre
        $formData = [
            'lastname' => $updateData['lastname_user'],
            'firstname' => $updateData['firstname_user'],
            'email' => $updateData['mail_user'],
            'departement' => $updateData['departement_user'],
            'age' => $updateData['age_user'],
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Mon Profil - Jeu-Concours</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- <div class="container"> Supprimé -->
        <h1>Modifier Mon Profil</h1>

        <?= $message ?>

        <form method="POST" novalidate>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" class="form-control" required
                    value="<?= htmlspecialchars($formData['lastname']) ?>">
            </div>

            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" class="form-control" required
                    value="<?= htmlspecialchars($formData['firstname']) ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required
                    value="<?= htmlspecialchars($formData['email']) ?>">
            </div>

            <!-- Les champs de mot de passe sont supprimés -->

            <div class="form-group">
                <label for="departement">Département</label>
                <select id="departement" name="departement" class="form-control" required>
                    <option value="">Choisir un Département</option>
                    <?php foreach ($departements as $dep): ?>
                        <option value="<?= $dep->id_dep ?>" <?= ($formData['departement'] == $dep->id_dep) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dep->Name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="age">Âge</label>
                <input type="number" id="age" name="age" class="form-control" min="18" max="120" required
                    value="<?= htmlspecialchars($formData['age']) ?>">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        </form>
        <p class="mt-3"><a href="index.php?page=profil">Retour au profil</a></p>
    <!-- </div> Supprimé -->

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>