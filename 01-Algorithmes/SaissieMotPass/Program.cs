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
const string BON_MOT_PASSE = "formation";
int essai = 0;
const int MAX_ESSAIE = 3;
string saisie;

//TRAITEMENT

while (essai < MAX_ESSAIE)
{
    Console.Write("Veuillez saisir votre mot passe : ");
    saisie = Console.ReadLine();

    if (saisie == BON_MOT_PASSE)
    {
        Console.WriteLine("Vous êtes connecté");
        return;
    }
    else
    {
        essai++;
        Console.WriteLine("Mot de passe incorrect. Veuillez réesayer.");   
    }
}

Console.WriteLine("Votre compte est bloqué");