<?php
// ProjetFileRouge/views/formMaj.php
// Ce fichier suppose que les variables suivantes sont définies par le contrôleur :
// $bien (tableau associatif des données du bien)
// $categories (tableau des catégories)
// $departements (tableau des départements)
// $utilisateurs_commerciaux (tableau des utilisateurs)
// $proprietaires (tableau des propriétaires)
// $erreurs (tableau associatif des erreurs de validation)
?>

<div class="container mt-4">

    <?php
    // Affichage des messages de succès ou d'erreur depuis la session
    if (isset($_SESSION['message_succes'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['message_succes']) . '</div>';
        unset($_SESSION['message_succes']);
    }
    if (isset($_SESSION['message_erreur'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['message_erreur']) . '</div>';
        unset($_SESSION['message_erreur']);
    }
    ?>

    <form action="index.php?action=maj_bien&id=<?= htmlspecialchars($bien['id'] ?? '') ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend class="mb-4">Modifier un Bien immobilier</legend>

            <div class="form-group mb-3">
                <label for="titre">Titre du bien : </label>
                <input type="text" name="titre" id="titre" class="form-control <?= isset($erreurs['titre']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($bien['titre'] ?? '') ?>" required />
                <?php if (isset($erreurs['titre'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['titre']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description : </label>
                <textarea name="description" id="description" class="form-control <?= isset($erreurs['description']) ? 'is-invalid' : '' ?>" rows="5" required><?= htmlspecialchars($bien['description'] ?? '') ?></textarea>
                <?php if (isset($erreurs['description'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['description']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="prix_vente">Prix de vente (€) : </label>
                <input type="number" step="0.01" name="prix_vente" id="prix_vente" class="form-control <?= isset($erreurs['prix_vente']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($bien['prix_vente'] ?? '') ?>" required min="0" />
                <?php if (isset($erreurs['prix_vente'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['prix_vente']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="surface">Surface (m²) : </label>
                <input type="number" step="0.01" name="surface" id="surface" class="form-control <?= isset($erreurs['surface']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($bien['surface'] ?? '') ?>" required min="0" />
                <?php if (isset($erreurs['surface'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['surface']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="nbr_pieces">Nombre de pièces : </label>
                <input type="number" name="nbr_pieces" id="nbr_pieces" class="form-control <?= isset($erreurs['nbr_pieces']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($bien['nbr_pieces'] ?? '') ?>" required min="0" />
                <?php if (isset($erreurs['nbr_pieces'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['nbr_pieces']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="ville">Ville : </label>
                <input type="text" name="ville" id="ville" class="form-control <?= isset($erreurs['ville']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($bien['ville'] ?? '') ?>" required />
                <?php if (isset($erreurs['ville'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['ville']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="num_departement">Département : </label>
                <select name="num_departement" id="num_departement" class="form-control <?= isset($erreurs['num_departement']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Sélectionnez un département</option>
                    <?php
                    if (isset($departements) && is_array($departements)) {
                        foreach ($departements as $dep) {
                            $selected = (isset($bien['num_departement']) && $bien['num_departement'] == $dep['id_dep']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($dep['id_dep']) . '" ' . $selected . '>' . htmlspecialchars($dep['nom_dep']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Aucun département disponible</option>';
                    }
                    ?>
                </select>
                <?php if (isset($erreurs['num_departement'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['num_departement']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="id_categorie">Catégorie : </label>
                <select name="id_categorie" id="id_categorie" class="form-control <?= isset($erreurs['id_categorie']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <?php
                    if (isset($categories) && is_array($categories)) {
                        foreach ($categories as $cat) {
                            $selected = (isset($bien['id_categorie']) && $bien['id_categorie'] == $cat['id_categorie']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($cat['id_categorie']) . '" ' . $selected . '>' . htmlspecialchars($cat['lib_categorie']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Aucune catégorie disponible</option>';
                    }
                    ?>
                </select>
                <?php if (isset($erreurs['id_categorie'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['id_categorie']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="ges">Diagnostic Énergétique (GES) : </label>
                <select name="ges" id="ges" class="form-control <?= isset($erreurs['ges']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Sélectionnez une classe</option>
                    <?php
                    $classesGes = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                    foreach ($classesGes as $class) {
                        $selected = (isset($bien['ges']) && strtoupper($bien['ges']) == $class) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($class) . '" ' . $selected . '>' . htmlspecialchars($class) . '</option>';
                    }
                    ?>
                </select>
                <?php if (isset($erreurs['ges'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['ges']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="classe_eco">Classe Énergétique (DPE) : </label>
                <select name="classe_eco" id="classe_eco" class="form-control <?= isset($erreurs['classe_eco']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Sélectionnez une classe</option>
                    <?php
                    $classesEco = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                    foreach ($classesEco as $class) {
                        $selected = (isset($bien['classe_eco']) && strtoupper($bien['classe_eco']) == $class) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($class) . '" ' . $selected . '>' . htmlspecialchars($class) . '</option>';
                    }
                    ?>
                </select>
                <?php if (isset($erreurs['classe_eco'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['classe_eco']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group form-check mb-3">
                <input type="checkbox" name="meuble" id="meuble" class="form-check-input" value="1" <?= (isset($bien['meuble']) && $bien['meuble'] == 1) ? 'checked' : '' ?> />
                <label class="form-check-label" for="meuble">Meublé</label>
            </div>

            <div class="form-group mb-3">
                <label for="localisation">Localisation (détails) : </label>
                <textarea name="localisation" id="localisation" class="form-control <?= isset($erreurs['localisation']) ? 'is-invalid' : '' ?>" rows="3"><?= htmlspecialchars($bien['localisation'] ?? '') ?></textarea>
                <?php if (isset($erreurs['localisation'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['localisation']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="charges_annuelles">Charges Annuelles (€) : </label>
                <input type="number" step="0.01" name="charges_annuelles" id="charges_annuelles" class="form-control <?= isset($erreurs['charges_annuelles']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($bien['charges_annuelles'] ?? '') ?>" min="0" />
                <?php if (isset($erreurs['charges_annuelles'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['charges_annuelles']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="id_utilisateur_commercial">Agent Commercial : </label>
                <select name="id_utilisateur_commercial" id="id_utilisateur_commercial" class="form-control <?= isset($erreurs['id_utilisateur_commercial']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Sélectionnez un agent</option>
                    <?php
                    if (isset($utilisateurs_commerciaux) && is_array($utilisateurs_commerciaux)) {
                        foreach ($utilisateurs_commerciaux as $user) {
                            $selected = (isset($bien['id_utilisateur_commercial']) && $bien['id_utilisateur_commercial'] == $user['id_utilisateur']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($user['id_utilisateur']) . '" ' . $selected . '>' . htmlspecialchars($user['prenom_utilisateur'] . ' ' . $user['nom_utilisateur']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Aucun agent disponible</option>';
                    }
                    ?>
                </select>
                <?php if (isset($erreurs['id_utilisateur_commercial'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['id_utilisateur_commercial']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="id_proprietaire">Propriétaire : </label>
                <select name="id_proprietaire" id="id_proprietaire" class="form-control <?= isset($erreurs['id_proprietaire']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Sélectionnez un propriétaire</option>
                    <?php
                    if (isset($proprietaires) && is_array($proprietaires)) {
                        foreach ($proprietaires as $prop) {
                            $selected = (isset($bien['id_proprietaire']) && $bien['id_proprietaire'] == $prop['id_proprietaire']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($prop['id_proprietaire']) . '" ' . $selected . '>' . htmlspecialchars($prop['prenom'] . ' ' . $prop['nom']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Aucun propriétaire disponible</option>';
                    }
                    ?>
                </select>
                <?php if (isset($erreurs['id_proprietaire'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($erreurs['id_proprietaire']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="img">Ajouter/Modifier un visuel principal du logement :</label>
                <?php if (!empty($bien['nom_fichier_photo'])): ?>
                    <p>Image actuelle : <img src="public/img/biens/<?= htmlspecialchars($bien['nom_fichier_photo']) ?>" alt="Image actuelle" style="max-width: 150px; height: auto; display: block; margin-top: 10px;"></p>
                <?php else: ?>
                    <p>Aucune image principale actuelle.</p>
                <?php endif; ?>
                <input type="file" name="photo" id="img" accept="image/*" class="form-control-file" />
                <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer l'image principale.</small>
            </div>

            <button type="submit" class="btn btn-success" name="envoiModification">Enregistrer les modifications</button>
            <a href="index.php?action=accueil" class="btn btn-secondary">Annuler</a>

        </fieldset>
    </form>
</div>