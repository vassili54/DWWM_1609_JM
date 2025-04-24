<?php
//------------------Exo Serie 2A--------------------

function getSum(int $num1, int $num2): int
{
    // Retourne simplement la somme des deux arguments
    return $num1 + $num2;
}

// Appelle la fonction avec 5 et 3, et affiche le résultat
echo getSum(5, 3); // affichera : 8

//-----------------Exo Serie 2B----------------------

function getSub(int $num1, int $num2): int
 {
    return $num1 - $num2;
 }



 echo getSub(5, 3);
 echo "\n"; // Ajoute un saut de ligne pour la clarté


 echo getSub(3, 5);
 echo "\n"; // Ajoute un saut de ligne pour la clarté

//-----------Exo Serie 2C-------------------------

function getMulti(float $num1, float $num2): float
{
   // Calcule la multiplication
   $result = $num1 * $num2;
   // Arrondit le résultat à 2 décimales
   $roundedResult = round($result, 2);
   // Retourne le résultat arrondi
   return $roundedResult;
}



echo getMulti(5.6, 3);
echo "\n"; // Ajoute un saut de ligne pour la clarté


echo getMulti(5.6, -3.7);
echo "\n"; // Ajoute un saut de ligne pour la clarté

//-----------------Exo Serie 2D----------------

function getDiv(int $num1, int $num2): float
{
    // Vérifier si le dénominateur est zéro pour éviter une erreur
    if ($num2 === 0) {
        return 0.0;
    }
    $result = $num1 / $num2;

    $roundedResult = round($result, 2);

    return $roundedResult;
}


echo getDiv(20, 3);
echo "\n";

echo getDiv(20, 0);
echo "\n";


?>