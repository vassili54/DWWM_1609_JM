<?php 
/**
 * Génère une liste HTML à partir d'un tableau
 * 
 * @param string $title Titre de la liste
 * @param array $items Tableau des éléments
 * @return string Code HTML généré
 */
function htmlList(string $title, array $items): string {
    $html = "<h3>$title</h3>";

    // Vérifie si le tableau est vide
    if (empty($items)) {
        return $html . "<p>Aucun résultat</p>";
    }

    // Trie les éléments par ordre alphabétique

}


?>