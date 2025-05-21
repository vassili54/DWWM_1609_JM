<?php
session_start();

require_once './RestoRepository.php';

$repo = new RestoRepository();
$restaurant = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        // Suppression de FILTER_SANITIZE_STRING, filter_input sans 3ème argument retourne la chaîne brute
        $nom = filter_input(INPUT_POST, 'nom');
        $adresse = filter_input(INPUT_POST, 'adresse');
        $commentaire = filter_input(INPUT_POST, 'Commentaire');
        $note = filter_input(INPUT_POST, 'Note', FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0, 'max_range' => 10]]);
        $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
        $visite = filter_input(INPUT_POST, 'visite'); // Date est une chaîne, pas besoin de FILTER_SANITIZE_STRING

        if (empty($nom) || empty($adresse) || $prix === false || $note === false) {
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Veuillez remplir tous les champs obligatoires (Nom, Adresse, Prix) et assurez-vous que la Note est un nombre entre 0 et 10.'];
            header('Location: fichedetail.php');
            exit;
        }

        $data = [
            'nom' => $nom,
            'adresse' => $adresse,
            'Commentaire' => $commentaire,
            'Note' => $note,
            'prix' => $prix,
            'visite' => !empty($visite) ? $visite : null
        ];

        try {
            $newId = $repo->ajouter($data);
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Restaurant ajouté avec succès ! ID: ' . $newId];
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => "Erreur lors de l'ajout du restaurant : " . htmlspecialchars($e->getMessage())];
            header('Location: fichedetail.php');
            exit;
        }

    } elseif ($action === 'modify' || $action === 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'ID de restaurant invalide pour la modification ou la suppression.'];
            header('Location: index.php');
            exit;
        }

        if ($action === 'modify') {
            // Suppression de FILTER_SANITIZE_STRING ici aussi
            $nom = filter_input(INPUT_POST, 'nom');
            $adresse = filter_input(INPUT_POST, 'adresse');
            $commentaire = filter_input(INPUT_POST, 'Commentaire');
            $note = filter_input(INPUT_POST, 'Note', FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0, 'max_range' => 10]]);
            $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
            $visite = filter_input(INPUT_POST, 'visite');

            if (empty($nom) || empty($adresse) || $prix === false || $note === false) {
                $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Veuillez remplir tous les champs obligatoires (Nom, Adresse, Prix) et assurez-vous que la Note est un nombre entre 0 et 10.'];
                header('Location: fichedetail.php?id=' . $id);
                exit;
            }

            $data = [
                'nom' => $nom,
                'adresse' => $adresse,
                'Commentaire' => $commentaire,
                'Note' => $note,
                'prix' => $prix,
                'visite' => !empty($visite) ? $visite : null
            ];

            try {
                $repo->modifier($id, $data);
                $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Restaurant modifié avec succès !'];
                header('Location: index.php');
                exit;
            } catch (Exception $e) {
                $_SESSION['flash_message'] = ['type' => 'danger', 'message' => "Erreur lors de la modification du restaurant : " . htmlspecialchars($e->getMessage())];
                header('Location: fichedetail.php?id=' . $id);
                exit;
            }

        } elseif ($action === 'delete') {
            try {
                $repo->deleteRow('restaurants', $id);
                $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Restaurant supprimé avec succès !'];
                header('Location: index.php');
                exit;
            } catch (Exception $e) {
                $_SESSION['flash_message'] = ['type' => 'danger', 'message' => "Erreur lors de la suppression du restaurant : " . htmlspecialchars($e->getMessage())];
                header('Location: fichedetail.php?id=' . $id);
                exit;
            }
        }
    }
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    try {
        $restaurant = $repo->searchById($id);
        if (!$restaurant) {
            $_SESSION['flash_message'] = ['type' => 'warning', 'message' => 'Restaurant non trouvé.'];
            header('Location: index.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => "Erreur lors de la récupération du restaurant : " . htmlspecialchars($e->getMessage())];
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $restaurant ? 'Détails du Restaurant' : 'Ajouter un Restaurant' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="text-center mb-4">
            <i class="bi bi-egg-fried"></i>
            <?= $restaurant ? 'Détails du Restaurant' : 'Ajouter un Nouveau Restaurant' ?>
        </h1>

        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="alert alert-' . $_SESSION['flash_message']['type'] . ' alert-dismissible fade show" role="alert">';
            echo $_SESSION['flash_message']['message'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>

        <form method="POST">
            <?php if ($restaurant): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($restaurant['id']) ?>">
                <input type="hidden" name="action" value="modify">
            <?php else: ?>
                <input type="hidden" name="action" value="add">
            <?php endif; ?>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($restaurant['nom'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?= htmlspecialchars($restaurant['adresse'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="Commentaire" class="form-label">Commentaire</label>
                <textarea class="form-control" id="Commentaire" name="Commentaire"><?= htmlspecialchars($restaurant['Commentaire'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="Note" class="form-label">Note (entre 0 et 10)</label>
                <input type="number" step="0.1" min="0" max="10" class="form-control" id="Note" name="Note" value="<?= htmlspecialchars($restaurant['Note'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (estimation)</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($restaurant['prix'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="visite" class="form-label">Date de dernière visite</label>
                <input type="date" class="form-control" id="visite" name="visite" value="<?= htmlspecialchars($restaurant['visite'] ?? '') ?>">
            </div>

            <?php if ($restaurant): ?>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Modifier</button>
                <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')"><i class="bi bi-trash"></i> Supprimer</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter</button>
            <?php endif; ?>

            <a href="index.php" class="btn btn-secondary ms-2"><i class="bi bi-arrow-left"></i> Retour à la liste</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>