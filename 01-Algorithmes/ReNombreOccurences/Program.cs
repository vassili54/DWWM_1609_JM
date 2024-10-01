/*
Rechercher le nombre d’occurences d’une lettre dans une phrase

Soit une chaîne de caractères terminée par le caractère « . ».
Donnez l’algorithme d’un programme qui compte le nombre d’occurrences d’une lettre donnée (“a” par exemple) dans cette chaîne.
Si la chaîne de caractères est vide ou n’est composée que d’un caractère « . », 
le message “LA CHAINE EST VIDE” sera affiché.
Proposez un jeu d’essai prévoyant les 3 cas suivants :
La phrase est vide
La lettre n’est pas présente
La lettre est présente une ou plusieurs fois
 */

//VARIABLES
int count;//compteur
string phrase;
char lettre;

Console.WriteLine("Entrez une phrase terminée par un point :");
phrase = Console.ReadLine();

if (string.IsNullOrEmpty(phrase) || phrase == ".") //Verifie si la chaine phrase est null ou vide
{ 
    Console.WriteLine("La chaine est vide");
    return;
}

Console.WriteLine("Entrez la lettre à chercher :");
lettre = Console.ReadLine()[0];

count = 0;
foreach (char c in phrase) //boucle foreach itérer une collection d'éléments comme un tableau
{
    if (c == lettre)
    {
        count++;
    }
}
Console.WriteLine("Le nombre d'occurances de " + lettre + " est : " + count + " ");