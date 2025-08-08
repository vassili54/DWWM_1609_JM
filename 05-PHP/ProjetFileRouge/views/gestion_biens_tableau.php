<?php
// ProjetFileRouge/views/gestion_biens_tableau.php
// Vue pour afficher les biens immobiliers sous forme de tableau pour la gestion.

// Assurez-vous que les variables $tableauBiens, $_SESSION['user_id'], et $_SESSION['user_niveau'] sont disponibles ici.
// Elles sont passées par CtrlAccueil ou CtrlFiltre.

echo "<section class='container mt-4'>"; // Conteneur principal avec marge supérieure
echo "<h2>Gestion des biens immobiliers</h2>";

// Affichage des messages de succès ou d'erreur depuis la session
if (isset($_SESSION['message_succes'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['message_succes']) . '</div>';
    unset($_SESSION['message_succes']); // Supprimer le message après l'affichage
}
if (isset($_SESSION['message_erreur'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['message_erreur']) . '</div>';
    unset($_SESSION['message_erreur']); // Supprimer le message après l'affichage
}

// Optionnel : Bouton pour ajouter un nouveau bien
// echo '<a href="index.php?action=ajouter_bien" class="btn btn-success mb-3">Ajouter un nouveau bien</a>';

if (!empty($tableauBiens)) {
    echo '<div class="table-responsive">'; // Rend le tableau scrollable sur les petits écrans
    echo '<table class="table table-striped table-hover">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Image</th>'; // NOUVEAU : Colonne pour l'image
    echo '<th>Titre</th>';
    echo '<th>Ville (Dépt)</th>';
    echo '<th>Prix</th>';
    echo '<th>Pièces</th>';
    echo '<th>Surface</th>';
    echo '<th>Catégorie</th>';
    echo '<th>Actions</th>'; // Colonne pour les boutons Modifier/Supprimer
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    $loggedInUserId = $_SESSION['user_id'] ?? null;
    $loggedInUserNiveau = $_SESSION['user_niveau'] ?? null;

    foreach ($tableauBiens as $bien) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($bien['id']) . '</td>';

        // --- NOUVEAU : Affichage de l'image principale ---
        $mainImageFileName = $bien['nom_fichier_photo'] ?? null;
        $vignetteFileName = 'thumbnail_' . ($mainImageFileName ?? 'placeholder.jpg');
        $imageSrcPath = 'public/img/vignettes/' . htmlspecialchars($vignetteFileName);
        $physicalImagePath = __DIR__ . '/../public/img/vignettes/' . $vignetteFileName;

        if (empty($mainImageFileName) || !file_exists($physicalImagePath) || is_dir($physicalImagePath)) {
            $imageSrcPath = 'public/img/biens/placeholder.jpg';
        }
        echo '<td><img src="' . $imageSrcPath . '" alt="' . htmlspecialchars($bien['titre'] ?? 'Image de bien') . '" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"></td>';
        // --- FIN NOUVEAU ---

        echo '<td>' . htmlspecialchars($bien['titre']) . '</td>';
        echo '<td>' . htmlspecialchars($bien['ville']) . ' (' . htmlspecialchars($bien['num_departement']) . ')</td>';
        echo '<td>' . htmlspecialchars(number_format($bien['prix_vente'], 0, ',', ' ')) . ' €</td>';
        echo '<td>' . htmlspecialchars($bien['nbr_pieces']) . '</td>';
        echo '<td>' . htmlspecialchars($bien['surface']) . ' m²</td>';
        echo '<td>' . htmlspecialchars($bien['lib_categorie']) . '</td>';
        echo '<td>';

        // Afficher les boutons Modifier/Supprimer uniquement si l'utilisateur a les droits
        if ($loggedInUserNiveau == 1 || ($loggedInUserNiveau == 2 && $bien['id_utilisateur_commercial'] == $loggedInUserId)) {
            echo '<a href="index.php?action=modifier&id=' . htmlspecialchars($bien['id']) . '" class="btn btn-warning btn-sm mr-1">Modifier</a>';
            echo '<a href="index.php?action=supprimer&id=' . htmlspecialchars($bien['id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce bien ?\');">Supprimer</a>';
        } else {
            echo '<span class="text-muted">Non autorisé</span>';
        }
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>'; // fin table-responsive
} else {
    echo '<div class="alert alert-info">Aucun bien immobilier trouvé pour le moment.</div>';
}
echo "</section>";
