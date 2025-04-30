<div class="mt-4 p-3 rounded <?= is_numeric($resultat) ? 'bg-success text-white' : 'bg-danger text-whrite' ?>">
    <?php if (is_numeric($resultat)): ?>
        <!-- Affichage du résultat valide -->
        <h3 class="h5">Résultat :</h3>
        <p class="mb-0">mensualité : <?= number_format($resultat, 2, ',', ' ') ?> €</p>
        <p class="mb-0">Total à rembourser : <?= number_format($resultat * 12 * $donnees['duree'], 2, ',', ' ') ?> €</p>
    <?php else: ?>
        <!-- Affichage des messages d'erreur -->
        <p class="mb-0"><?= htmlspecialchars($resultat) ?></p>
    <?php endif; ?>
</div>

<!-- Affichage du tableau d'amortissement -->
<?php if (is_numeric($resultat) && !empty($donnees['tableau_html'])): ?>
<div class="mt-5">
    <h4 class="mb-3">Tableau d'amortissement du prêt</h4>
    <div class="table-responsive">
        <?= $donnees['tableau_html'] ?>
    </div>
</div>

<!-- Données JSON pour exploitation -->
<script>
    const amortissementData = <?= json_encode($donnees['tableau_array']) ?>;
    console.log('Données du tableau d\'amortissement:', amortissementData);

    // Exemple d'utilisation des données
    document.addEventListener('DOMContentLoaded' function() {

    }); 
</script>
<?php endif; ?>