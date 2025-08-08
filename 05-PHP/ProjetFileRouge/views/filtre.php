<?php

// ProjetFileRouge/views/fitre.php




echo "<section>";
echo '<div class="container">'; // Conteneur principal pour la page d'accueil
if (!empty($biens)) {
        foreach ($biens as $bien) {
            // Début de la "carte" pour chaque bien
            echo '<div class="col-xs-12 col-sm-4 col-md-3">'; // 1 colonne sur très petit, 2 sur petit, 3 sur moyen
            echo '<div class="panel panel-default bien-card">'; // Utilisation d'un panel pour la carte

            // GESTION DE L'IMAGE
            // Chemin de l'image. Utilisez 'placeholder.jpg' si 'nom_fichier_photo' est vide ou null.
            // Assurez-vous que le dossier 'public/img/biens/' existe et contient vos images.
            $imagePath = 'public/img/biens/' . htmlspecialchars($bien['nom_fichier_photo'] ?? 'placeholder.jpg'); 
            
            // Vérifie si le fichier image existe sur le disque pour éviter les erreurs 404
            // Note: Cette vérification côté PHP est bonne, mais le chemin dans src doit être relatif au navigateur.
            // Assurez-vous que 'public/img/biens/' est accessible via HTTP.
            if (!file_exists(__DIR__ . '/public/img/biens/' . ($bien['nom_fichier_photo'] ?? 'placeholder.jpg')) || is_dir(__DIR__ . '/public/img/biens/' . ($bien['nom_fichier_photo'] ?? 'placeholder.jpg'))) {
                $imagePath = 'public/img/biens/placeholder.jpg'; // Chemin vers votre image par défaut si le fichier n'existe pas
            }

            echo '<div class="bien-photo-container">';
            echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($bien['titre']) . '" class="img-responsive bien-photo">';
            echo '</div>'; // fin bien-photo-container

            echo '<div class="panel-body">'; // Utilise panel-body pour le contenu
            echo '<h4>' . htmlspecialchars($bien['titre']) . '</h4>';
            echo '<p><strong>Prix :</strong> ' . htmlspecialchars(number_format($bien['prix_vente'], 0, ',', ' ')) . ' €</p>';
            echo '<p><strong>Ville :</strong> ' . htmlspecialchars($bien['ville']) . ' (' . htmlspecialchars($bien['num_departement']) . ')</p>';
            
            // Affichage du nombre de pièces (comme avant)
            echo '<p><strong>Pièces :</strong> ';
            if (isset($bien['nbr_pieces']) && $bien['nbr_pieces'] > 0) {
                echo htmlspecialchars($bien['nbr_pieces']);
            } else {
                echo '-';
            }
            echo '</p>';
            
            echo '<p><strong>Surface :</strong> ' . htmlspecialchars($bien['surface']) . ' m²</p>';
            echo '<p class="bien-description">' . htmlspecialchars(substr($bien['description'], 0, 100)) . (strlen($bien['description']) > 100 ? '...' : '') . '</p>';
            
            // Bouton pour voir plus de détails (vous pouvez le lier à une page de détail si vous en avez une)
            // Idéalement, ce lien devrait inclure l'ID du bien: href="detail_bien.php?id=' . htmlspecialchars($bien['id']) . '"
            echo '<a href="#" class="btn btn-primary">Voir les détails</a>';  // 'btn-block' a été supprimé

            echo '</div>'; // fin panel-body
            echo '</div>'; // fin panel bien-card
            echo '</div>'; // fin col
            // --- Fin de la "carte" pour chaque bien ---
        }
    } else {
        echo '<div class="col-xs-12"><p class="alert alert-info">Aucun bien immobilier trouvé pour le moment.</p></div>';
    }
    echo '</div>'; // fin row bien-list-container
echo"</div>"; // Fin de la div container principale
echo "</section>";
    ?>

