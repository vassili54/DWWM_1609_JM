<?php

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/../dao/Dbconnect.php';
require_once __DIR__ . '/../dao/CandidateRepository.php';

$message = ''; // Variable pour stocker les messages de succès ou d'erreur
$formData = [
    'email' => '',
];

// Vérifie si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['email'] = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($formData['email']) || empty($password)) {
        $message = '<div class="error">Veuillez remplir tous les champs.</div>';
    } else if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="error">Format d\'email invalide.</div>';
    } else {
        try {
            $candidateRepo = new CandidateRepository();
            $user = $candidateRepo->signIn($formData['email'], $password);
            if ($user) {
                // Authentification réussie
                $_SESSION['user_id'] = $user->id_user; // Stocke l'ID de l'utilisateur en session
                $_SESSION['user_email'] = $user->mail_user; // Optionnel: stocker d'autres infos
                // Redirection vers la page de profil via index.php
                header('Location: index.php?page=profil');
                exit;
            } else {
                $message = '<div class="error">Email ou mot de passe incorrect.</div>';
            }
        } catch (Exception $e) {
            $message = '<div class="error">Une erreur est survenue: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Jeu-Concours</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- <div class="container"> Supprimé -->
        <h1>Connexion Candidat</h1>

        <?= $message ?>

        <form method="POST" novalidate>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required
                    value="<?= htmlspecialchars($formData['email']) ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-input-container">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('password', 'toggleIconPassword')">
                        <i class="fas fa-eye" id="toggleIconPassword"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Se connecter</button>
        </form>
        <p class="mt-3">Pas encore inscrit ? <a href="index.php?page=inscription">Inscrivez-vous ici</a>.</p>
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