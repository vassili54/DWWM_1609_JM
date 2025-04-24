<?php 

//-----------------Serie 5A-------------------

/**
 * Retourne le premier élément d'un tableau ou null si vide
 * 
 * @param array $array Le tableau à analyser
 * @return mixed|null Le premier élément ou null
 */
function firstItem(array $array) {
    return $array[0] ?? null;
}

// Test avec le tableau fourni
$names = ['Joe', 'Jack', 'Léa', 'Zoé', 'Néo'];
echo firstItem($names) . "\n"; // Affiche "Joe"

// Test avec un tableau vide
$emptyArray = [];
var_dump(firstItem($emptyArray)) . "\n";  // Affiche "NULL"

//-----------------Serie 5B-------------------

function lastItem(array $array) {
    // empty() pour vérifier si le tableau est vide
    // count() pour obtenir la taille du tableau
    return empty($array) ? null : $array[count($array) - 1];
    // Accès à l'index count($array) - 1 pour le dernier élément
}

// Test avec le tableau fourni
$names = ['Joe', 'Jack', 'Léa', 'Zoé', 'Néo'];
echo lastItem($names) . "\n"; // Affiche "Néo"

// Test avec un tableau vide
$emptyArray = [];
var_dump(lastItem($emptyArray)) . "\n"; // Affiche NULL

//-----------------Serie 5C-------------------


/**
 * Trie un tableau par ordre décroissant en conservant les associations clé-valeur
 * Version améliorée avec gestion des accents et préservation du tableau original
 * 
 * @param array $items Tableau à trier
 * @return array Tableau trié ou tableau vide si entrée vide
 */
function sortItems(array $items): array {
    // Tableau vide ? On renvoie du vide, point barre
    if (empty($items)) {
        return [];
    }

    // Trie décroissant avec rsort, et c’est plié
    rsort($items);
    return $items;
}
function displayHorizontal(array $items) {
    if (empty($items)) {
        echo "[]\n";
        return;
    }
    echo "[" . implode(", ", $items) . "]\n";
}

// Test avec le tableau de l'exo
$names = ['Jack', 'Zoé', 'Léa', 'Néo', 'Joe'];
$namesSorted = sortItems($names);
displayHorizontal($namesSorted);

// Test avec un tableau vide
$empty = [];
$emptySorted = sortItems($empty);
displayHorizontal($emptySorted);

/* Le implode() dans les tests, 
c’est juste pour afficher les résultats proprement, 
mais la fonction retourne bien un tableau. */


//-----------------Serie 5D-------------------

function stringItems(array $items): string {
    // Si le tableau est vide, on renvoie le message demandé
    if (empty($items)) {
        return "Nothing to display";
    }
    // On trie en croissant avec sort(), puis on jointe avec ", "
    sort($items);
    return implode(",", $items);
}

$names = ['Jack', 'Zoé', 'Léa', 'Néo', 'Joe'];
echo stringItems($names) . "\n"; // Jack, Joe, Léa, Néo, Zoé

$empty = [];
echo stringItems($empty) . "\n"; // Nothing to display

?>