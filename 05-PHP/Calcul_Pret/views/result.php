<div class="mt-4 p-3 rounded <?= is_numeric($resultat) ? 'bg-success text-white' : 'bg-danger text-whrite' ?>">
    <?php if (is_numeric($resultat)): ?>
        <h3 class="h5">Résultat :</h3>
        <p class="mb-0">mensualité : <?= number_format($resultat, 2, ',', ' ') ?> €</p>
        <p class="mb-0">Total à rembourser : <?= number_format($resultat * 12 * $donnees['duree'], 2, ',', ' ') ?> €</p>
    <?php else: ?>
        <p class="mb-0"><?= htmlspecialchars($resultat) ?></p>
    <?php endif; ?>
</div>