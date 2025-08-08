<?php
session_start();

// Définir les pages autorisées pour éviter les inclusions de fichiers arbitraires
$allowedPages = ['inscription', 'connexion', 'profil', 'modifier_profil', 'logout'];
// Définir la page par défaut si aucune n'est spécifiée ou si elle n'est pas autorisée
$page = $_GET['page'] ?? 'connexion'; // Par défaut, on affiche la connexion

if (!in_array($page, $allowedPages)) {
    $page = 'connexion'; // Ou une page d'erreur 404 si vous en avez une
}

// Si l'utilisateur demande à se déconnecter et que la page est 'logout'
if ($page === 'logout') {
    // Le script views/logout.php gère la déconnexion et la redirection.
    // Il est important qu'il redirige vers index.php?page=connexion
    include __DIR__ . '/views/logout.php';
    exit; // S'assurer que le script s'arrête après l'inclusion de logout.php
}

// Logique de base pour la navigation et l'inclusion de contenu
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu-Concours</title>
    <!-- Les liens CSS sont relatifs à index.php maintenant -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Styles additionnels pour la navigation si nécessaire */
        nav ul { list-style-type: none; padding: 0; margin-bottom: 20px; text-align: center; }
        nav ul li { display: inline; margin-right: 15px; }
        nav ul li a { text-decoration: none; color: #007bff; }
        nav ul li a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="form-container">
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?page=profil">Mon Profil</a></li>
                    <li><a href="index.php?page=modifier_profil">Modifier Profil</a></li>
                    <li><a href="index.php?page=logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=inscription">Inscription</a></li>
                    <li><a href="index.php?page=connexion">Connexion</a></li>
                <?php endif; ?>
                 <li><a href="Test_Inscri.php">Voir Inscrits (Test)</a></li>
            </ul>
        </nav>

        <?php
        // Inclure la vue demandée
        // Le chemin est relatif à index.php
        $viewPath = __DIR__ . '/views/' . $page . '.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            // Gérer le cas où le fichier de vue n'existe pas (même si $allowedPages devrait le prévenir)
            echo "<p>Erreur : La page demandée n'a pas pu être chargée.</p>";
        }
        ?>
    </div>
    <!-- Les scripts JS globaux pourraient être ici si nécessaire -->
</body>
</html>