<?php 
//-------------------Serie 7A-------------------
/*
 * Vérifie si une chaîne contient au moins 9 caractères
 * 
 * @param string $input La chaîne à vérifier
 * @return bool true si ≥ 9 caractères, false sinon



function stringLength(string $input):bool {
    // Utilise la fonction PHP strlen() pour obtenir la longueur de la chaîne.
    return strlen($input) >= 9;
}
// Tests
// Utilisation de var_dump() pour afficher clairement le booléen retourné.
var_dump(stringLength("MotDePasseLong")); // Bool(true)
var_dump(stringLength("azer")); // Bool (false)

*/

//-------------------Serie 7B-------------------

/**
 * Vérifie la complexité d'un mot de passe selon des règles spécifiques
 * 
 * @param string $password Le mot de passe à vérifier
 * @return bool true si toutes les règles sont respectées, false sinon
 */
function passwordCheck(string $password): bool {
    // Vérification de la longueur avec la fonction existante
    if (!stringLength($password)) {
        return false;
    }

    // Contient au moins 1 chiffre
    if (!preg_match('/\d/', $password)) {
        return false;
    }

    // Contient au moins une majuscule ET une minuscule
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Contient au moins 1 caractère non alphanumérique
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return false;
    }

    return true;
}

// Function stringLength() de l'exercice 7A
function stringLength(string $input): bool {
    return strlen($input) >= 9;
}

// Tests
echo "\nTests passwordCheck():\n";
echo "-------------------\n";
var_dump(passwordCheck("GoodPass123!")); // true (tous critères)
var_dump(passwordCheck("weak")); // false (trop court)
var_dump(passwordCheck("NoSpecialChar123")); // false (manque caractère special)
var_dump(passwordCheck("nocaps123!")); // false (manque majuscule)
var_dump(passwordCheck("NOLOWER123!")) . "\n"; // false (manque minuscule)

//-------------------Serie 7C-------------------
// array un conteneur polyvalent pour stocker et gérer des collections de données sous une seule variable
function userLogin(string $username, string $password, array $users): bool {
    // Vérifie si l'utilisateur existe 
    if (!array_key_exists($username, $users)) {
        return false;
    }

    // Vérifie la correspondance du mot de passe
    return $password === $users[$username];
}

// Tableau des utilisateurs (simulant une base de données)
$users = [
    'joe' => 'Azer1234!',
    'jack' => 'Azer-4321',
    'admin' => '1234_Azer',
];

// Tests
echo "\nTests userLogin():\n";
echo "-------------------\n";
var_dump(userLogin('joe', 'Azer1234!', $users)); // true (bon identifiant)
var_dump(userLogin('jack', 'mauvaisMDP', $users)); // false (mauvais mot passe)
var_dump(userLogin('inconnu', 'test', $users)); // false (utilisateur inexistant)


?>