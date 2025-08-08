<?php

session_start();

/* HEADER entête avec dépendances CSS
   ================================================== */
include "views/header.php";


/* NAVBAR
   ================================================== */
include "views/menu.php";

/* Carousel
   ================================================== */
include "views/slider.php";

// --- DÉBUT DES MODIFICATIONS POUR LE FORMULAIRE DE RECHERCHE ---

// Inclusion du DAO pour les biens immobiliers (déplacé ici pour être accessible au formulaire)
require_once "models/dao/BienImmobilierDAO.php";
$bienDAO = new BienImmobilierDAO(); // Instanciation du DAO

// Récupérer les départements pour le menu déroulant
$departements = $bienDAO->getDepartements();

// Récupérer les categories pour le menu déroulent
$categories = $bienDAO->getCategories();

// Récupérer les valeurs soumises par le formulaire pour les pré-remplir
// Utilisation de l'opérateur de coalescence nulle (??) pour éviter les "Undefined index" warnings
$selectedDep = $_GET['dep'] ?? '';
$selectedBudget = $_GET['budget'] ?? '';
$selectedNbPieces = $_GET['nbpieces'] ?? '';
$selectedCategory = $_GET['categorie'] ?? '';

echo '<h1>Liste des biens immobiliers</h1>';

echo '<form action="index.php" method="GET" enctype="multipart/form-data" >
            <fieldset><legend>Rechercher un Bien immobilier</legend>

            <div class="form-group">
                <input type="hidden" name="lib_cat" value="" id="lib_cat" />

                <label for="dep">Choisir le département</label>'; // ID du label corrigé de 'dept' à 'dep'

echo '<select name="dep" id="dep" class="form-control" style=" max-width:300px"><option value="">Choisissez votre département</option> ';
// Boucle pour remplir le select des départements avec pré-sélection
foreach ($departements as $dep) {
    $selected = ($selectedDep == $dep['id_dep']) ? 'selected' : '';
    echo '<option value="' . htmlspecialchars($dep['id_dep']) . '" ' . $selected . '>' . htmlspecialchars($dep['nom_dep']) . '</option>';
}
echo '</select>';
echo ' </div>
<div class="form-group">

<label for="budget">Montant budget maximum</label>
    <span class="currencyinput">
<input type="number" step="10000" id="budget" name="budget" placeholder="Budget Max" min="50000" max="900000000" value="' . htmlspecialchars($selectedBudget) . '" />€
</span>
</div>

<div class="form-group">
<label for="nbpieces" >Nombre de pièces souhaitées</label>'; // ID du label corrigé de 'nbpiece' à 'nbpieces'

echo '<select name="nbpieces" id="nbpieces" class="form-control" style=" max-width:300px"><option value=" " >Choisissez le nombre de pièce</option>'; // ID du select corrigé de 'nbre' à 'nbpieces'
// Options statiques pour le nombre de pièces avec pré-sélection
$nbPiecesOptions = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
foreach ($nbPiecesOptions as $num) {
    // Vérifie si la valeur soumise correspond, en ignorant les espaces supplémentaires si l'option par défaut est " "
    $selected = (trim($selectedNbPieces) == $num) ? 'selected' : '';
    echo '<option value="' . htmlspecialchars($num) . '" ' . $selected . '>' . htmlspecialchars($num) . '</option>';
}
echo "</select></div>";

echo '<div class="form-group">';
echo '<label for="categorie">Choisir une catégorie</label>';
echo '<select name="categorie" id="categorie" class="form-control" style="max-width:300px"><option value="">toutes les catégories</option>';
// Boucle pour remplir le select des catégories
foreach ($categories as $cat) {
    $selected = ($selectedCategory == $cat['id_categorie']) ? 'selected' : '';
    echo '<option value="' . htmlspecialchars($cat['id_categorie']) . '" ' . $selected . '>' . htmlspecialchars($cat['lib_categorie']) . '</option>';
}
echo '</select>';
echo '</div>';


echo  '
            <div class="form-group form-button" id="btnsub" >
<button type="submit" class="btn btn-primary" name="envoi">Submit</button>
    </div>
    </fieldset>
    </form>';

// --- FIN DES MODIFICATIONS POUR LE FORMULAIRE DE RECHERCHE ---


// Récupérer et afficher les biens immobiliers en utilisant les filtres du formulaire
try {
    // Appel de la méthode getAllBiens avec les paramètres de recherche
    $biens = $bienDAO->getAllBiens($selectedDep, $selectedBudget, $selectedNbPieces, $selectedCategory);

    echo '<table class="table table-striped table-bordered" style="margin-top: 30px;">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Titre</th>';
    // echo '<th>Catégorie</th>';
    echo '<th>Pièces</th>';
    echo '<th>Description</th>';
    echo '<th>Surface</th>';
    echo '<th>Prix</th>';
    echo '<th>Ville</th>';
    echo '<th>Code Postal</th>';
    echo '<th>Photo</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if (!empty($biens)) {
        foreach ($biens as $bien) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($bien['id']) . '</td>';
            echo '<td>' . htmlspecialchars($bien['titre']) . '</td>';
            // echo '<td>' . htmlspecialchars($bien['lib_categorie']) . '</td>';
            echo '<td>';
            // Affiche le nombre de pièces si la valeur existe et est supérieure à 0
            if (isset($bien['nbr_pieces']) && $bien['nbr_pieces'] > 0) {
                echo htmlspecialchars($bien['nbr_pieces']);
            } else {
                echo '-'; // Affiche un tiret si le nombre de pièces n'est pas applicable ou est 0
            }
            echo '</td>';
            echo '<td>' . htmlspecialchars(substr($bien['description'], 0, 100)) . (strlen($bien['description']) > 100 ? '...' : '') . '</td>';
            echo '<td>' . htmlspecialchars($bien['surface']) . ' m²</td>';
            echo '<td>' . htmlspecialchars(number_format($bien['prix_vente'], 0, ',', ' ')) . ' €</td>';
            echo '<td>' . htmlspecialchars($bien['ville']) . '</td>';
            echo '<td>' . htmlspecialchars($bien['num_departement']) . '</td>';
            echo '<td>';
            echo 'N/A'; // Comme discuté, la gestion des photos nécessite une jointure supplémentaire.
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="10">Aucun bien immobilier trouvé pour le moment.</td></tr>';
    }
    echo '</tbody>';
    echo '</table>';

} catch (PDOException $e) {
    echo '<p class="alert alert-danger">Erreur lors de la récupération des biens : ' . htmlspecialchars($e->getMessage()) . '</p>';
    error_log("Erreur PDO lors de l'affichage des biens: " . $e->getMessage());
}


include("views/acces_membre.php");


/* Pied de page avec dépendances Javascript...
   ================================================== */
include("views/footer.php");

?>