<?php 
/**
 * Génère une liste HTML à partir d'un tableau
 * 
 * @param string $title Titre de la liste
 * @param array $items Tableau des éléments
 * @return string Code HTML généré
 */


 /*
function htmlList(string $title, array $items): string {
    $html = "<h3>$title</h3>";

    // Vérifie si le tableau est vide
    if (empty($items)) {
        return $html . "<p>Aucun résultat</p>";
    }

    // Trie les éléments par ordre alphabétique
    sort($items); // sort() prend le tableau $items en argument et le trie par ordre alphabétique

    // Génère la liste HTML
    $html .= "<ul>";
    foreach ($items as $item) {
        $html .= "<li>" . htmlspecialchars($item) . "</li>";
    }
    $html .= "</ul>";
    
    return $html;
}
*/

// Version plus concise de la fonction htmlList
// Cette version utilise array_map pour générer les éléments de la liste


/*
function htmlList(string $title, array $items): string {
    if (empty($items)) {
        return "<h3>$title</h3><p>Aucun résultat</p>";
    }
    
    sort($items);
    $listItems = array_map(fn($item) => "<li>".htmlspecialchars($item)."</li>", $items);
    
    return "<h3>$title</h3><ul>".implode("", $listItems)."</ul>";
}

 */

function htmlList(string $title, array $items): string {
    // Vérifie si le tableau des éléments est vide.
    // empty() retourne true si le tableau ne contient aucun élément.
    if (empty($items)) {
        // Si le tableau est vide, retourne directement la chaîne HTML du titre et un message d'absence de résultat.
        // Les chaînes de caractères retournées peuvent contenir du texte en Français si ce n'est pas spécifié autrement.
        return "<h3>$title</h3><p>Aucun résultat</p>";
        // Note : htmlspecialchars est ajouté au titre aussi par bonne pratique.
    }
    // Trie les éléments du tableau par ordre alphabétique.
    // sort() modifie le tableau $items directement.
    sort($items);

    // Utilise array_map pour transformer chaque élément du tableau en une chaîne de caractère <li>...</li>.
    // array_map() applique la fonction (ici une fonction anonyme 'fn') à chaque élément du tableau $items.
    // fn($item) => "<li>" . htmlspecialchars($item) . "</li>" est une fonction anonyme (définie et utilisée sur place).
    // Elle prend un élément ($item) et retourne la balise <li> contenant l'élément échappé pour la sécurité avec htmlspecialchars().
    // Le résultat de array_map est un nouveau tableau ($listItems) contenant toutes les chaînes <li>...</li> générées.
    $listItems = array_map(fn($item) => "<li>" .htmlspecialchars($item)."</li>", $items); // Nom de variable en Anglais

    // Construit et retourne la chaîne HTML finale.
    // Elle concatène ('.') :
    // 1. La balise du titre <h3>.
    // 2. La balise d'ouverture <ul>.
    // 3. Le résultat de implode("", $listItems).
    //    implode() joint les éléments du tableau $listItems en une seule chaîne.
    //    Le premier argument ("") est le séparateur utilisé entre les éléments (ici, une chaîne vide, donc pas de séparateur).
    //    Cela assemble toutes les balises <li> générées par array_map.
    // 4. La balise de fermeture </ul>.
    return "<h3>$title</h3><ul>" .implode("", $listItems)."</ul>";
    // Note : htmlspecialchars est ajouté au titre aussi par bonne pratique.
}



// Tests 
$names = ['Joe', 'Jack', 'Léa', 'Zoé', 'Néo'];
echo htmlList("Liste des personnes", $names);

$emptyArray = [];
echo htmlList("liste vide", $emptyArray);




?>