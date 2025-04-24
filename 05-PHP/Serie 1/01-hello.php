<?php
/**
* Affiche "Hello World !"
*/
function helloWorld() : void
{ 
  echo "Hello World !";
}

// test de la fonction (la fonction affiche directement le résultat)
helloWorld();

// --------second exo-----------------------
/**
* Retourne "Hello $name !"
* @param string $name le nom à afficher
*/
function hello(string $name):string
{
    return "Hello $name";
}

// test de la fonction (la fonction n'affiche rien. "echo" affichera la valeur retournée par la fonction)

echo hello("Jéjé");

//-----------------Exo Serie 1A------------------------

/**
* Retourne "Hello $name !"
* @param string $name le nom à afficher
*/
function hello(string $name):string
{
    // Vérifier si la chaîne $name est vide
    if ($name === "") {
        return "Nobody"; // Retourner "Nobody" si le nom est vide
    }
    // Sinon (si le nom n'est pas vide), retourner la salutation normale
    return "Hello $name";
}

// test de la fonction (la fonction n'affiche rien. "echo" affichera la valeur retournée par la fonction)

echo hello(""); // Affichera : Nobody





?>