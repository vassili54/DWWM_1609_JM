<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur de Prêt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

<?php
require_once 'classes/Pret.php';

// Traitement du formulaire
$donnees = [
    'montant' => $_POST['montant_pret'] ?? '',
    'taux' => $_POST['taux_interet'] ?? '',
    'duree' => $_POST['duree_pret_annees'] ?? ''
];

$resultat = null;
$tab = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoi'])) {
    try {
        $montant = floatval($_POST['montant_pret']);
        $taux = floatval($_POST['taux_interet'] );
        $duree = intval($_POST['duree_pret_annees']);

        if ($montant <= 0 || $taux <= 0) {
            throw new Exception("Le montant et le taux doivent être positifs");
        }

        $objmonPret = new Pret($montant, $taux, $duree);
        $resultat = $objmonPret->calculMensualite();
        $tab = $objmonPret->tableauAmortissement();

    } catch (Exception $e) {
        $resultat = $e->getMessage();
    }
}
?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">Calculateur de mensualité</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php" >
                            <div class="mb-3">
                                <label for="montant_pret" class="form-label">Montant du prêt (€)</label>
                                <input type="number" class="form-control" name="montant_pret" id="montant_pret"
                                    value="<?= htmlspecialchars($donnees['montant']) ?>" step="100" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="taux_interet" class="form-label">Taux d'intérêt annuel (%)</label>
                                <input type="number" class="form-control" name="taux_interet" id="taux_interet"
                                    value="<?= htmlspecialchars($donnees['taux']) ?>" step="0.01" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="duree_pret_annees" class="form-label">Durée (années)</label>
                                <input type="number" class="form-control" name="duree_pret_annees" id="duree_pret_annees"
                                    value="<?= htmlspecialchars($donnees['duree']) ?>" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="envoi"   >Calculer</button>
                        </form>

                        <?php if ($resultat !== null): ?>
                            <div class="mt-3 alert <?= is_numeric($resultat) ? 'alert-success' : 'alert-danger' ?>">
                                <?php if (is_numeric($resultat)): ?>
                                    <h4>Résultat :</h4>
                                    <p>Mensualité : <?= number_format($resultat, 2, ',', ' ') ?> €</p>
                                <?php else: ?>
                                    <p><?= htmlspecialchars($resultat) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <?php if (!empty($tab)): ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4 class="mb-3">Tableau d'amortissement du prêt</h4>
                <div class="table-responsive">
                    <?= $tab ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($tab)): ?>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="export_json.php" method="post" class="text-center">
                    <input type="hidden" name="montant_pret" value="<?= htmlspecialchars($donnees['montant']) ?>">
                    <input type="hidden" name="taux_interet" value="<?= htmlspecialchars($donnees['taux']) ?>">
                    <input type="hidden" name="duree_pret_annees" value="<?= htmlspecialchars($donnees['duree']) ?>">
                    <button type="submit" class="btn btn-secondary">Exporter le tableau en JSON</button>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>