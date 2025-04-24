<?php

//-----------------Serie 4A---------------------

/* function isMajor : Définit une fonction nommée isMajor */
/* (int $age) : Accepte un paramètre $age de type entier */
/* bool : Indique que la fonction retourne un booléen (true/false) */
function isMajor(int $age): bool {  
    return $age >= 18;
}
echo var_dump(isMajor(19));
/* Exemples d'utilisation
var_dump(isMajor(12));  // bool(false)
var_dump(isMajor(18));  // bool(true)
var_dump(isMajor(42));  // bool(true)
*/

//-----------------Serie 4B---------------------

/**
 * Détermine le statut de retraite en fonction de l'âge avec des messages humoristiques
 * 
 * @param int $age L'âge à évaluer
 * @return string Message personnalisé concernant la retraite
 */
function getRetired(int $age): string {
    // Vérification d'un âge négatif invalide
    if ($age < 0) {
        return "T'es pas né, gros malin ! 😜";
    // Cas : Pas encore à la retraite    
    } elseif ($age < 60) {
        $yearsLeft = 60 - $age;
        return "Encore $yearsLeft ans à trimer avant la retraite, courage mon pote 💪!";
    // Cas : Âge exact de la retraite    
    } elseif ($age == 60) {
        return "T'es pile à la retraite, profite bien, vieille branche ! 😎";
    // Cas par défaut : Déjà à la retraite 
    } else {
        $yearsRetired = $age - 60;
        return "T'es à la retraite depuis $yearsRetired ans, la belle vie, hein ? 🏖️";
    }
}
// Tests de la fonction
 echo getRetired(20) . "\n";

//-----------------Serie 4C---------------------

/**
 * Trouve le maximum parmi trois nombres flottants
 * Retourne 0 si au moins deux nombres sont égaux
 * 
 * @param float $num1 Premier nombre à comparer
 * @param float $num2 Deuxième nombre à comparer
 * @param float $num3 Troisième nombre à comparer
 * @return float Le plus grand nombre ou 0 si égalité détectée
 */
function getMax(float $num1, float $num2, float $num3): float {
    // Vérification des égalités entre les nombres
    if ($num1 == $num2 || $num1 == $num3 || $num2 == $num3) {
        return 0;
    }
    
    // Détermination du maximum
    $max = $num1;
    if ($num2 > $max) {
        $max = $num2;
    }
    if ($num3 > $max) {
        $max = $num3;
    }
    
    // Limitation à 3 décimales
    return round($max, 3);
}

// Tests de la fonction
echo getMax(1.23456, 2.34567, 3.45678) . "\n";  // 3.457
echo getMax(1.111, 1.111, 2.222) . "\n";        // 0 (égalité)
echo getMax(5.678, 3.456, 5.678) . "\n";        // 0 (égalité)
echo getMax(0.1234, -0.4321, 0.9999) . "\n";    // 0.999

//-----------------Serie 4D---------------------

/**
 * Retourne la capitale d'un pays donné en utilisant une structure switch
 * 
 * @param string $country Le pays dont on cherche la capitale
 * @return string La capitale du pays ou "Capitale inconnue"
 */
function capitalCity(string $country): string {
    // Conversion de la chaîne en minuscules pour une comparaison insensible à la casse
    $normalizedCountry = strtolower(trim($country)); // strtolower() standardise la casse. trim() supprime les espaces
    
    switch ($normalizedCountry) {
        case 'france':
            return 'Paris';
        case 'allemagne':
            return 'Berlin';
        case 'italie':
            return 'Rome';
        case 'maroc':
            return 'Rabat';
        case 'espagne':
            return 'Madrid';
        case 'portugal':
            return 'Lisbonne';
        case 'angleterre':
            return 'Londres';
        default:
            return 'Capitale inconnue';
    }
}

// Tests de la fonction
echo capitalCity('France') . "\n";    
echo capitalCity('Italie') . "\n";      
echo capitalCity('Portugal') . "\n";    
echo capitalCity('Canada') . "\n";      
echo capitalCity('  ESPAGNE  ') . "\n";
echo capitalCity('AlLeMaGnE') . "\n";   

?>