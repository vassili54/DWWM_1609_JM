<?php
// index.php
// Démarre une session PHP
session_start();
// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Redirige vers la page d'accueil si l'utilisateur est déjà connecté
    header('Location: home.php');
    exit();// On arrête l'exécution du script après la redirection
}
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface d'authentification pour scientifiques habilités</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <nav>

        </nav>
    </header>
    <main>
        <div class="login-container">
            <h1>Connexion</h1>

            <?php if (isset($_GET['error'])): ?>
                <p class="error">Identifiants incorrects</p>
            <?php endif; ?>
            
            <form action="auth.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>

        </div>
    </main>
    <footer>

    </footer>
</body>

</html>