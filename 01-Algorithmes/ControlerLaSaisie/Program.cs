/*
Contrôler la saisie avec limite:
L’utilisateur est invité à saisir un mot de passe.
Si le mot de passe saisi est correct, le programme affiche “Vous êtes connecté”.
Dans le cas contraire, l’utilisateur doit recommencer la saisie.
L’utilisateur dispose de 3 essais maximum.
Au 3ème échec, le programme affiche “Votre compte est bloqué” et se termine.

Note : Le bon mot de passe est formation
  */

//VARIABLES
const string bonMotPasse = "formation";
int essai = 0;
string saisie;
Boolean estIdentifier = false;

//TRAITEMENT

while (essai < 3 && !estIdentifier)
{
    Console.WriteLine("Veuillez saisir votre mot passe");
    saisie = Console.ReadLine();

    if (saisie == bonMotPasse)
    {
        Console.WriteLine("Vous êtes connecté");
        estIdentifier = true;
    }
    else
    {
        essai++;
        if (essai < 3)
        {
            Console.WriteLine("Mot de passe incorrect. Veuillez réessayer.");
        }
    }
}