/*
Exercice 2a.3 : Ma retraite
Lire un nombre A correspondant à un âge (en années).
Selon l’âge fourni, le programme doit afficher l’un des messages suivants :
Vous êtes à la retraite depuis X années
Il vous reste X années avant la retraite.
C’est le moment de prendre sa retraite.
La valeur fournie n’est pas un âge valide.
La retraite est fixée à 60 ans. 
 */

//VARIABLES
int age;
const int ageRetraite = 60;
string saisieUtilisateur;

//Traitement
Console.WriteLine("Entrez votre âge : ");
saisieUtilisateur = Console.ReadLine();

//affichage
if (int.TryParse(saisieUtilisateur, out age))
{
    if (age < 0 || age > 120) // Vérification d'un âge valide
    {
        Console.WriteLine("La valeur fournie n’est pas un âge valide.");
    }
    else if (age < ageRetraite)
    {
        int anneesRestantes = ageRetraite - age;
        Console.WriteLine("Il vous reste " + anneesRestantes + " années avant la retraite.");
    }
    else if (age == ageRetraite)
    {
        Console.WriteLine("C’est le moment de prendre sa retraite.");
    }
    else
    {
        int anneesRetraite = age - ageRetraite;
        Console.WriteLine("Vous êtes à la retraite depuis " + anneesRetraite + " années.");
    }
}
else
{
    Console.WriteLine("La valeur fournie n’est pas un âge valide.");
}