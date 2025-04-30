<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <!-- Métadonnées standards -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur de Prêt</title>
    <!-- Inclusion des feuilles de style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Carte Bootstrap pour le formulaire -->
                <div class="card shadow">
                    <!-- En-tête de la carte -->

                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">Calculateur de mensualité</h2>
                    </div>
                    <!-- Corps de la carte -->
                    <div class="card-body">
                        <!-- Formulaire de saisie -->
                        <form method="post">
                            <!-- Champ Montant -->
                            <div class="mb-3">
                                <label for="montant_pret" class="form-label"> Montant du prêt (€)</label>
                                <input type="number" class="form-control" name="montant_pret" id="montant_pret"
                                    value="<?= htmlspecialchars($donnees['montant']) ?>" step="100" min="0" required>
                            </div>
                            <!-- Champ Taux -->
                            <div class="mb-3">
                                <label for="taux_interet" class="form-label">Taux d'interêt annuel (%)</label>
                                <input type="number" class="form-control" name="taux_interet" id="taux_interet"
                                    value="<?= htmlspecialchars($donnees['taux']) ?>" step="0.01" min="0" required>
                            </div>
                            <!-- Champ Durée -->
                            <div class="mb-3">
                                <label for="duree_pret_annees" class="form-label">Durée (années)</label>
                                <input type="number" class="form-control" name="duree_pret_annees" id="duree_pret_annees"
                                    value="<?= htmlspecialchars($donnees['duree']) ?>" min="1" required>
                            </div>
                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn btn-primary w-100">Calculer</button>
                        </form>
                        <!-- Affichage conditionnel du résultat -->
                        <?php if ($resultat !== null): ?>
                            <?php require 'views/result.php'; ?>
                        <?php endif; ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inclusion des scripts JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>