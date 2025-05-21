<?php
session_start();

require_once './RestoRepository.php';

$repo = new RestoRepository();

// Gérer l'action de génération du JSON si le bouton est pressé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'generate_json') {
    try {
        $repo->chercherCollection('plat'); // Appel pour générer plat.json
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Fichier plat.json généré avec succès dans dataobjet/ !'];
    } catch (Exception $e) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => "Erreur lors de la génération du fichier JSON : " . htmlspecialchars($e->getMessage())];
    }
    // Redirection pour éviter le re-submit du formulaire au rafraîchissement
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Restaurants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="text-center mb-4"><i class="bi bi-book"></i> Mon Guide Restaurants</h1>

        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="alert alert-' . $_SESSION['flash_message']['type'] . ' alert-dismissible fade show" role="alert">';
            echo $_SESSION['flash_message']['message'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>

        <div class="d-flex justify-content-center mb-4 gap-2">
            <a href="fichedetail.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter un restaurant</a>

            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="generate_json">
                <button type="submit" class="btn btn-info"><i class="bi bi-file-earmark-code"></i> Extraire en JSON</button>
            </form>

            <a href="./afficher_json.php" target="_blank" class="btn btn-secondary">
                <i class="bi bi-box-arrow-up-right"></i> Ouvrir JSON (page web)
            </a>
        </div>

        <?= $repo->rendre_html('restaurants') ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>