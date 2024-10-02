/* 
L’utilisateur est invité à saisir son prénom.
Le programme affiche ensuite “Bonjour” suivi du prénom saisi.
Le prénom doit contenir au moins 2 caractères.
Si le prénom contient moins de 2 caractères, l’utilisateur doit recommencer la saisie.
L’utilisateur dispose d’un nombre d’essai illimité. 
*/



//VARIABLES

string prenom;

//TRAITEMENT

/*
String formatPrenom = @"^[a-zA-Z]{2,32}$i";

while (!Regex.IsMatch(prenom, formatPrenom, RegexOptions|IgnoreCase))
{
    Console.WriteLine("Saisissez un vrai prénom !");
    prenom = Console.ReadLine();
}
 
Console.WriteLine("Bonjour " + prenom + " !");

 */

do
{
    Console.Write("Veuillez saisir votre prénom (au moins 2 caractères) : ");
    prenom = Console.ReadLine();
} while (prenom.Length < 2);

//AFFICHAGE

Console.WriteLine("Bonjour " + prenom + " !");