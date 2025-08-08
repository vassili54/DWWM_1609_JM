<?php

// ProjetFileRouge/views/formFiltre.php


require_once 'models/dao/BienImmobilierDAO.php';
require_once 'controllers/CtrlAccueil.php'; // Inclure le contrôleur pour l'accueil
require_once 'controllers/CtrlFiltre.php'; // Inclure le contrôleur pour les filtres

?>

<form action="index.php?action=updateBien&id=<?= htmlspecialchars($bien['id'] ?? '') ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Modifier un Bien immobilier</legend>

        <div class="form-group">
            <label for="titre">Titre du bien : </label>
            <input type="text" name="titre" id="titre" class="form-control" value="<?= htmlspecialchars($bien['titre'] ?? '') ?>" required />
        </div>

        <div class="form-group">
            <label for="description">Description : </label>
            <textarea name="description" id="description" class="form-control" rows="5" required><?= htmlspecialchars($bien['description'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="prix_vente">Prix de vente : </label>
            <input type="number" name="prix_vente" id="prix_vente" class="form-control" value="<?= htmlspecialchars($bien['prix_vente'] ?? '') ?>" required min="0" />
        </div>

        <div class="form-group">
            <label for="surface">Surface (m²) : </label>
            <input type="number" name="surface" id="surface" class="form-control" value="<?= htmlspecialchars($bien['surface'] ?? '') ?>" required min="0" />
        </div>

        <div class="form-group">
            <label for="nbr_pieces">Nombre de pièces : </label>
            <input type="number" name="nbr_pieces" id="nbr_pieces" class="form-control" value="<?= htmlspecialchars($bien['nbr_pieces'] ?? '') ?>" required min="1" />
        </div>

        <div class="form-group">
            <label for="ville">Ville : </label>
            <input type="text" name="ville" id="ville" class="form-control" value="<?= htmlspecialchars($bien['ville'] ?? '') ?>" required />
        </div>

        <div class="form-group">
            <label for="num_departement">Département : </label>
            <input type="text" name="num_departement" id="num_departement" class="form-control" value="<?= htmlspecialchars($bien['num_departement'] ?? '') ?>" required />
            </div>

        <div class="form-group">
            <label for="id_categorie">Catégorie : </label>
            <select name="id_categorie" id="id_categorie" class="form-control" required>
                <?php
                // Supposons que $categories est un tableau de toutes les catégories passé par le contrôleur
                // et $bien['id_categorie'] est l'ID de la catégorie actuelle du bien.
                if (isset($categories) && is_array($categories)) {
                    foreach ($categories as $cat) {
                        $selected = (isset($bien['id_categorie']) && $bien['id_categorie'] == $cat['id_categorie']) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($cat['id_categorie']) . '" ' . $selected . '>' . htmlspecialchars($cat['lib_categorie']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="img">Ajouter/Modifier un visuel principal du logement :</label>
            <?php if (!empty($bien['nom_fichier_photo'])): ?>
                <p>Image actuelle : <img src="public/img/biens/<?= htmlspecialchars($bien['nom_fichier_photo']) ?>" alt="Image actuelle" style="max-width: 150px; height: auto; display: block; margin-top: 10px;"></p>
            <?php endif; ?>
            <input type="file" name="img" id="img" accept="image/*" class="form-control-file" />
            <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer l'image principale.</small>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
        <a href="index.php?action=admin" class="btn btn-secondary">Annuler</a>
    </fieldset>    
</form>