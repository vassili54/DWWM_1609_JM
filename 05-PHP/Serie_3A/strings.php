<?php

//-------------Serie 3A--------------------

function getMC2(): string
{
    // La fonction retourne simplement la chaîne de caractères contenant le nom.
    return "Albert Einstein";
}

echo "L'inventeur de E=MC² est : ";
echo getMC2(); // Affichera : Albert Einstein
echo "\n";

//---------------Serie 3B---------------------

function getUserName(string $firstName, string $lastName): string
{
    // Concatène le prénom (minuscule), un espace, et le nom (MAJUSCULE)
    return $firstName . $lastName;
}

echo getUserName('max', 'jéjé');

//----------------Serie 3C-----------------

function getFullName(string $lastName, string $firstName): string
{
    // Convertit le prénom en minuscules
    $lowerFirstName = strtolower($firstName);  /* strtolower($firstName) : Convertit le prénom en minuscules */

    // Convertit le nom en MAJUSCULES
    $upperLastName = strtoupper($lastName); /* strtoupper($lastName) : Convertit le nom en majuscules */

    // Concatène le prénom (minuscule), un espace, et le nom (MAJUSCULE)
    return $lowerFirstName . " " . $upperLastName;
}

echo getFullName('max', 'jéjé');

//-------------Serie 3D--------------------

/* Formate un prénom et un nom en une chaîne stylisée. */
function getFullName(string $lastName, string $firstName): string /* getFullName() - Formate un nom complet */
{
    /* ucfirst Met la première lettre en majuscule*/
    /* strtolower($firstName) : Convertit le prénom en minuscules */
    /* strtoupper($lastName) : Convertit le nom en majuscules */
    return ucfirst(strtolower($firstName)) . ' ' . strtoupper($lastName);
}

function getMC2(): string
{
    return "Albert Einstein";
}

function askUser(string $lastName, string $firstName): string /* askUser() - Combine les deux fonctions pour générer une phrase */
{
    $fullNameFormatted = getFullName($lastName, $firstName);

    $inventorFullName = getMC2();
    
    $nameParts = explode(' ', $inventorFullName); /* explode() découpe une chaîne en tableau */
    $inventorLastName = end($nameParts); /* end() récupère la dernière valeur d'un tableau */

    $finalString = "Bonjour " . $fullNameFormatted . ", connaissez-vous " . $inventorLastName . " ?";

    return $finalString;
}

echo askUser('max', 'jéjé'); 

?>