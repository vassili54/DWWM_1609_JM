<?php
// controllers/CtrlMiseAjour.php

require_once __DIR__ . '/../models/dao/BienImmobilierDAO.php';

function controleurMajBien(int $id)
{
    $bienDAO = new BienImmobilierDAO();
    $erreurs = [];
    $bien = []; // Les données du bien (issues de la DB ou du POST)

    // --- DÉBUT : Définition des chemins des images ---
    $base_project_path = __DIR__ . '/../';
    $img_path = $base_project_path . 'public/img/biens/';
    $vignette_path = $base_project_path . 'public/img/vignettes/';
    // --- FIN : Définition des chemins des images ---

    $categories = $bienDAO->getCategories();
    $departements = $bienDAO->getDepartements();
    $utilisateurs_commerciaux = $bienDAO->getUtilisateursCommerciaux();
    $proprietaires = $bienDAO->getProprietaires();

    // --- NOUVEAU : Vérification des droits d'accès au bien ---
    $bienAModifier = $bienDAO->getBienById($id);

    if (!$bienAModifier) {
        $_SESSION['message_erreur'] = "Bien immobilier non trouvé.";
        header('Location: index.php?action=accueil');
        exit();
    }

    $isAuthorized = false;
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_niveau'])) {
        $loggedInUserId = $_SESSION['user_id'];
        $loggedInUserNiveau = $_SESSION['user_niveau'];

        if ($loggedInUserNiveau == 1) { // Superadmin
            $isAuthorized = true; // Le Superadmin peut modifier n'importe quel bien
        } elseif ($loggedInUserNiveau == 2) { // Agent Commercial
            // Un agent commercial ne peut modifier que ses propres biens
            if ($bienAModifier['id_utilisateur_commercial'] == $loggedInUserId) {
                $isAuthorized = true;
            } else {
                $_SESSION['message_erreur'] = "Vous n'êtes pas autorisé à modifier ce bien. Il ne vous est pas attribué.";
                header('Location: index.php?action=gestion_biens'); // Rediriger vers la liste des biens de l'agent
                exit();
            }
        }
    }

    if (!$isAuthorized) {
        $_SESSION['message_erreur'] = "Accès non autorisé. Veuillez vous connecter avec les droits nécessaires.";
        header('Location: index.php?action=login');
        exit();
    }
    // --- FIN NOUVEAU : Vérification des droits d'accès au bien ---


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'id'                          => $id,
            'titre'                       => filter_input(INPUT_POST, 'titre', FILTER_UNSAFE_RAW),
            'nbr_pieces'                  => filter_input(INPUT_POST, 'nbr_pieces', FILTER_VALIDATE_INT),
            'surface'                     => filter_input(INPUT_POST, 'surface', FILTER_VALIDATE_FLOAT),
            'prix_vente'                  => filter_input(INPUT_POST, 'prix_vente', FILTER_VALIDATE_FLOAT),
            'description'                 => filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW),
            'ges'                         => filter_input(INPUT_POST, 'ges', FILTER_UNSAFE_RAW),
            'classe_eco'                  => filter_input(INPUT_POST, 'classe_eco', FILTER_UNSAFE_RAW),
            'meuble'                      => filter_input(INPUT_POST, 'meuble', FILTER_VALIDATE_INT),
            'localisation'                => filter_input(INPUT_POST, 'localisation', FILTER_UNSAFE_RAW),
            'num_departement'             => filter_input(INPUT_POST, 'num_departement', FILTER_VALIDATE_INT),
            'ville'                       => filter_input(INPUT_POST, 'ville', FILTER_UNSAFE_RAW),
            'charges_annuelles'           => filter_input(INPUT_POST, 'charges_annuelles', FILTER_VALIDATE_FLOAT),
            'id_utilisateur_commercial'   => filter_input(INPUT_POST, 'id_utilisateur_commercial', FILTER_VALIDATE_INT),
            'id_categorie'                => filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT),
            'id_proprietaire'             => filter_input(INPUT_POST, 'id_proprietaire', FILTER_VALIDATE_INT),
        ];

        // --- Début de la validation ---
        if (empty($data['titre'])) {
            $erreurs['titre'] = "Le titre est requis.";
        }
        if ($data['nbr_pieces'] === false || $data['nbr_pieces'] < 0) {
            $erreurs['nbr_pieces'] = "Le nombre de pièces doit être un nombre entier positif.";
        }
        if ($data['surface'] === false || $data['surface'] <= 0) {
            $erreurs['surface'] = "La surface doit être un nombre valide et positif.";
        }
        if ($data['prix_vente'] === false || $data['prix_vente'] <= 0) {
            $erreurs['prix_vente'] = "Le prix de vente doit être un nombre valide et positif.";
        }
        if (empty($data['description'])) {
            $erreurs['description'] = "La description est requise.";
        }
        if (empty($data['ges']) || !in_array(strtoupper($data['ges']), ['A', 'B', 'C', 'D', 'E', 'F', 'G'])) {
            $erreurs['ges'] = "Le GES doit être une lettre entre A et G.";
        }
        if (empty($data['classe_eco']) || !in_array(strtoupper($data['classe_eco']), ['A', 'B', 'C', 'D', 'E', 'F', 'G'])) {
            $erreurs['classe_eco'] = "La classe énergétique doit être une lettre entre A et G.";
        }

        if ($data['meuble'] === null) {
            $data['meuble'] = 0;
        }

        if (empty($data['localisation'])) {
            $erreurs['localisation'] = "La localisation est requise.";
        }
        if ($data['num_departement'] === false || $data['num_departement'] <= 0) {
            $erreurs['num_departement'] = "Le département est requis.";
        }
        if (empty($data['ville'])) {
            $erreurs['ville'] = "La ville est requise.";
        }
        if ($data['charges_annuelles'] === false || $data['charges_annuelles'] < 0) {
            $erreurs['charges_annuelles'] = "Les charges annuelles doivent être un nombre valide.";
        }
        if ($data['id_utilisateur_commercial'] === false || $data['id_utilisateur_commercial'] <= 0) {
            $erreurs['id_utilisateur_commercial'] = "L'utilisateur commercial est requis.";
        }
        if ($data['id_categorie'] === false || $data['id_categorie'] <= 0) {
            $erreurs['id_categorie'] = "La catégorie est requise.";
        }
        if ($data['id_proprietaire'] === false || $data['id_proprietaire'] <= 0) {
            $erreurs['id_proprietaire'] = "Le propriétaire est requis.";
        }
        // --- Fin de la validation ---

        // --- NOUVEAU : Vérification des droits pour id_utilisateur_commercial en POST ---
        // Un agent commercial ne peut pas changer l'utilisateur commercial du bien
        if ($loggedInUserNiveau == 2 && $data['id_utilisateur_commercial'] != $loggedInUserId) {
            $erreurs['id_utilisateur_commercial'] = "Un agent commercial ne peut pas modifier l'agent attribué au bien.";
            // Forcer l'ID de l'utilisateur commercial à être celui de l'agent connecté
            $data['id_utilisateur_commercial'] = $loggedInUserId;
        }
        // --- FIN NOUVEAU ---

        // --- Logique d'UPLOAD d'IMAGE ---
        if (empty($erreurs)) {
            if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
                $file = $_FILES['photo'];
                $temp_name = $file['tmp_name'];
                $original_name = $file['name'];
                $file_error = $file['error'];

                if ($file_error !== UPLOAD_ERR_OK) {
                    $_SESSION['message_erreur'] = "Erreur lors du téléchargement du fichier: " . $file_error;
                    $bien = $data;
                } else {
                    $image_info = getimagesize($temp_name); // Get image info including MIME type and dimensions
                    if ($image_info === false) {
                        $_SESSION['message_erreur'] = "Le fichier téléchargé n'est pas une image valide.";
                        $bien = $data;
                    } else {
                        $mime_type = $image_info['mime'];
                        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION)); // Get actual extension from original name

                        // Validate MIME type and extension
                        $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
                        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                        if (!in_array($mime_type, $allowed_mime_types) || !in_array($extension, $allowed_extensions)) {
                            $_SESSION['message_erreur'] = "Type de fichier image non supporté. Seuls JPG, PNG, GIF sont autorisés.";
                            $bien = $data;
                        } else {
                            $newName = 'photo' . uniqid() . '.' . $extension;
                            $destination = $img_path . $newName;

                            if (move_uploaded_file($temp_name, $destination)) {
                                $vignetteName = 'thumbnail_' . $newName;
                                $largeur = $image_info[0]; // Width
                                $hauteur = $image_info[1]; // Height
                                $ratio = $largeur / $hauteur;
                                $dest_width = 700;
                                $dest_height = round($dest_width / $ratio); // Calculate height based on new width and original ratio

                                $image = imagecreatetruecolor($dest_width, $dest_height);
                                $source = null;

                                // Create image from source based on detected MIME type
                                switch ($mime_type) {
                                    case 'image/jpeg':
                                        $source = imagecreatefromjpeg($destination);
                                        break;
                                    case 'image/png':
                                        $source = imagecreatefrompng($destination);
                                        // Preserve transparency for PNG
                                        imagealphablending($image, false);
                                        imagesavealpha($image, true);
                                        break;
                                    case 'image/gif':
                                        $source = imagecreatefromgif($destination);
                                        break;
                                }

                                // IMPORTANT : Vérifier si $source et $image ont été créés avec succès
                                if ($source !== false && $image !== false) {
                                    imagecopyresampled($image, $source, 0, 0, 0, 0, $dest_width, $dest_height, $largeur, $hauteur);

                                    // Save thumbnail based on original extension
                                    switch ($extension) {
                                        case 'jpg':
                                        case 'jpeg':
                                            imagejpeg($image, $vignette_path . $vignetteName);
                                            break;
                                        case 'png':
                                            imagepng($image, $vignette_path . $vignetteName);
                                            break;
                                        case 'gif':
                                            imagegif($image, $vignette_path . $vignetteName);
                                            break;
                                    }
                                    imagedestroy($image);
                                    imagedestroy($source); // Correction de la faute de frappe ici

                                    $image_id = $bienDAO->insertImage(
                                        $newName,
                                        $data['titre'],
                                        $extension
                                    );

                                    if ($image_id) {
                                        if (!$bienDAO->updateOrCreateMainImageAssociation($id, $image_id)) {
                                            $_SESSION['message_erreur'] = "Erreur lors de l'association de l'image principale au bien.";
                                        }
                                        $data['nom_fichier_photo'] = $newName;
                                        // $data['nom_fichier_vignette'] = $vignetteName; // Pas nécessaire de stocker ceci dans $data pour la DB
                                    } else {
                                        $_SESSION['message_erreur'] = "Erreur lors de l'enregistrement de l'image dans la base de données.";
                                    }
                                } else {
                                    $_SESSION['message_erreur'] = "Erreur lors de la création de l'image GD ou de la source (fichier corrompu ou non supporté).";
                                    $bien = $data;
                                }
                            } else {
                                $_SESSION['message_erreur'] = "Erreur lors du déplacement du fichier téléchargé sur le serveur.";
                                $bien = $data;
                            }
                        }
                    }
                }
            }

            // Si aucune erreur de validation et pas d'erreur critique d'upload
            if (empty($erreurs)) {
                if ($bienDAO->updateBien($data)) {
                    $_SESSION['message_succes'] = "Bien immobilier mis à jour avec succès !";
                    header('Location: index.php?action=gestion_biens'); // Rediriger vers la liste des biens de l'agent/admin
                    exit();
                } else {
                    $_SESSION['message_erreur'] = "Erreur lors de la mise à jour du bien immobilier en base de données.";
                    $bien = $data; // Pré-remplir le formulaire avec les données soumises
                }
            } else {
                $_SESSION['message_erreur'] = "Veuillez corriger les erreurs dans le formulaire.";
                $bien = $data; // Pré-remplir le formulaire avec les données soumises
            }
        } else {
            $_SESSION['message_erreur'] = "Veuillez corriger les erreurs dans le formulaire.";
            $bien = $data; // Pré-remplir le formulaire avec les données soumales
        }
    } else { // Chargement initial du formulaire (méthode GET)
        // Les données du bien à modifier ont déjà été récupérées en haut de la fonction ($bienAModifier)
        $bien = $bienAModifier; // Utiliser les données du bien récupérées pour pré-remplir le formulaire
    }

    // Inclure la vue du formulaire de modification
    // La vue aura accès à $bien, $erreurs, $categories, $departements, etc.
    require_once './views/formMaj.php';
}
