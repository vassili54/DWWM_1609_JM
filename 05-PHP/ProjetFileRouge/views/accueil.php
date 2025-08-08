<?php
// ProjetFileRouge/views/accueil.php
// Vue pour afficher les biens immobiliers sous forme de cartes sur la page d'accueil.

echo "<section>";
echo '<div class="container-liste">'; // Conteneur principal pour la page d'accueil

// Affichage des messages de succès ou d'erreur depuis la session
if (isset($_SESSION['message_succes'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['message_succes']) . '</div>';
    unset($_SESSION['message_succes']); // Supprimer le message après l'affichage
}
if (isset($_SESSION['message_erreur'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['message_erreur']) . '</div>';
    unset($_SESSION['message_erreur']); // Supprimer le message après l'affichage
}

echo '<div class="row bien-list-container">'; // Conteneur Flexbox pour les cartes de biens

if (!empty($tableauBiens)) {
    foreach ($tableauBiens as $bien) {
        echo '<div class="col-xs-12 col-sm-4 col-md-3">'; // Colonnes responsives pour les cartes
        echo '<div class="panel panel-default bien-card">'; // Utilisation d'un panel pour la carte

        // --- DÉBUT DE LA GESTION DE L'IMAGE ---
        $mainImageFileName = $bien['nom_fichier_photo'] ?? null; // Récupère le nom du fichier de l'image principale
        $vignetteFileName = 'thumbnail_' . ($mainImageFileName ?? 'placeholder.jpg');
        $imageSrcPath = 'public/img/vignettes/' . htmlspecialchars($vignetteFileName);
        $physicalImagePath = __DIR__ . '/../public/img/vignettes/' . $vignetteFileName;

        // Vérifier si le nom de l'image principale est absent de la DB OU
        // si le fichier de la vignette n'existe pas physiquement OU est un dossier par erreur.
        if (empty($mainImageFileName) || !file_exists($physicalImagePath) || is_dir($physicalImagePath)) {
            // Si pas de photo ou photo non trouvée/invalide, utiliser l'image de substitution standard
            $imageSrcPath = 'public/img/biens/placeholder.jpg'; // Chemin vers votre image de remplacement
        }
        // --- FIN DE LA GESTION DE L'IMAGE ---

        echo '<div class="bien-photo-container">';
        echo '<img src="' . $imageSrcPath . '" alt="' . htmlspecialchars($bien['titre'] ?? 'Image de bien') . '" class="img-responsive bien-photo">';
        echo '</div>'; // fin bien-photo-container

        echo '<div class="panel-body">'; // Utilise panel-body pour le contenu
        echo '<h4>' . htmlspecialchars($bien['titre']) . '</h4>';
        echo '<p><strong>Prix :</strong> ' . htmlspecialchars(number_format($bien['prix_vente'], 0, ',', ' ')) . ' €</p>';
        echo '<p><strong>Ville :</strong> ' . htmlspecialchars($bien['ville']) . ' (' . htmlspecialchars($bien['num_departement']) . ')</p>';

        echo '<p><strong>Pièces :</strong> ';
        if (isset($bien['nbr_pieces']) && $bien['nbr_pieces'] > 0) {
            echo htmlspecialchars($bien['nbr_pieces']);
        } else {
            echo '-';
        }
        echo '</p>';

        echo '<p><strong>Surface :</strong> ' . htmlspecialchars($bien['surface']) . ' m²</p>';
        echo '<p class="bien-description">' . htmlspecialchars(substr($bien['description'], 0, 100)) . (strlen($bien['description']) > 100 ? '...' : '') . '</p>';

        // Bouton pour voir plus de détails
        echo '<a href="#" class="btn btn-primary mb-2">Voir les détails</a>';

        // --- Liens Modifier/Supprimer (visibles uniquement en mode "gestion_biens" et avec les droits) ---
        // Cette section est déplacée vers views/gestion_biens_tableau.php pour la vue tableau
        // et retirée de accueil.php car cette vue est pour l'affichage public.
        // Si vous souhaitez les conserver sur les cartes en mode gestion, vous devrez adapter cette logique.
        // Pour l'objectif actuel (cartes en accueil, tableau en gestion), ces boutons ne sont pas ici.
        // --- FIN des liens Modifier/Supprimer ---

        echo '</div>'; // fin panel-body
        echo '</div>'; // fin panel bien-card
        echo '</div>'; // fin col
    }
} else {
    echo '<div class="col-xs-12"><p class="alert alert-info">Aucun bien immobilier trouvé pour le moment.</p></div>';
}
echo '</div>'; // fin row bien-list-container
echo "</div>"; // Fin de la div container principale
echo "</section>";
?>
