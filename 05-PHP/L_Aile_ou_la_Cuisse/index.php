<?php
require_once './RestoRepository.php';

$repo = new RestoRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $repo->deleteRow('restaurants', $id);
    header('Location: index.php');
    exit;
}

try {
    $restaurants = $repo->searchAll();
} catch (Exception $e) {
    die("<div class='alert alert-danger'><i class='bi bi-exclamation-octagon'></i> ".htmlspecialchars($e->getMessage())."</div>");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Restaurants - Colmar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="text-center mb-4"><i class="bi bi-egg-fried"></i> Nos Restaurants à Colmar</h1>

        <?php if (empty($restaurants)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Aucun restaurant à afficher pour le moment.
            </div>
        <?php else: ?>
            <?= $repo->rendre_html('restaurants') ?>
        <?php endif; ?>
    </div>

    <footer class="mt-5 py-3 text-center text-muted">
        <small>© <?= date('Y') ?> Guide Restaurants - Colmar</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
