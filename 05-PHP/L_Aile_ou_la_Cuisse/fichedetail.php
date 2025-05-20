<?php
require_once './RestoRepository.php';

$repo = new RestoRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modify'])) {
        $id = $_POST['id'];
        $data = [
            'nom' => $_POST['nom'],
            'adresse' => $_POST['adresse'],
            'Commentaire' => $_POST['Commentaire'],
            'Note' => $_POST['Note'],
            'prix' => $_POST['prix']
        ];
        $repo->modifyRow('restaurants', $id, $data);
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $repo->deleteRow('restaurants', $id);
        header('Location: index.php');
        exit;
    }
}

$id = $_GET['id'] ?? null;
if ($id) {
    $restaurant = $repo->searchById($id);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="text-center mb-4"><i class="bi bi-egg-fried"></i> Détails du Restaurant</h1>

        <?php if ($restaurant): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($restaurant['id']) ?>">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($restaurant['nom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" value="<?= htmlspecialchars($restaurant['adresse']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="Commentaire" name="Commentaire" required><?= htmlspecialchars($restaurant['Commentaire']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="Note" class="form-label">Note</label>
                    <input type="number" class="form-control" id="Note" name="Note" value="<?= htmlspecialchars($restaurant['Note']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($restaurant['prix']) ?>" required>
                </div>
                <button type="submit" name="modify" class="btn btn-primary">Modifier</button>
                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')">Supprimer</button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-octagon"></i> Restaurant non trouvé.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
