/*
Exercice 6.2 : Jeu du “0 - 2”
A tour de rôle, l’ordinateur et le joueur choisissent un nombre qui ne peut prendre que 3 valeurs: 0, 1 ou 2.

Le choix du nombre par l’ordinateur sera simulé par génération d’un nombre aléatoire : N <-- RANDOM

Si la différence entre les nombres choisi vaut :

2 : le joueur qui a proposé le plus grand nombre gagne un point.
1 : le joueur qui a proposé le plus petit nombre gagne un point.
0 : aucun point n’est marqué.
Le jeu se termine quand un des deux joueurs (l’ordinateur ou le joueur humain)
totalise 10 points ou quand l’être humain introduit un nombre négatif qui indique sa volonté d’arrêter de jouer.

Dans les 2 cas, afficher les scores.
*/

Random random = new Random();
int scoreJoueur = 0, scoreOrdi = 0;
int choixJoueur, choixOrdi;

Console.WriteLine("Bienvenue au jeu '0 - 2' !");

while (scoreJoueur < 10 && scoreOrdi < 10) 
{
    //Choix de l'ordi
    choixOrdi = random.Next(0, 3);

    //Demander au joueur de faire un choix
    Console.WriteLine("Entrez votre choix (0, 1, 2) ou un nombre négatif pour quitter : ");
    choixJoueur = int.Parse(Console.ReadLine());

    //Vérification de l'arrêt du jeu
    if (choixJoueur < 0) 
    {
        Console.WriteLine("Vous avez choisi d'arrêter le jeu.");
        break;
    }

    //Vérification des choix valides
    if (choixJoueur < 0 || choixJoueur > 2) 
    {
        Console.WriteLine("Choix invalide. Veuillez entrer 0, 1 ou 2.");
        continue;
    }
    Console.WriteLine($"Vous avez choisi : {choixJoueur}, Ordinateur a choisi : {choixOrdi}");

    //Calcul des points
    int difference = Math.Abs(choixJoueur - choixOrdi);
    if (difference == 2)
    {
        scoreJoueur += choixJoueur > choixOrdi ? 1 : 0;
        scoreOrdi += choixOrdi < choixJoueur ? 1 : 0;
    }
    else if (difference == 1) 
    {
        scoreJoueur += choixJoueur < choixOrdi ? 1 : 0;
        scoreOrdi += choixOrdi > choixJoueur ? 1 : 0;
    }

    Console.WriteLine($"Scores -> Vous : {scoreJoueur}, Ordinateur : {scoreOrdi}");
}

Console.WriteLine($"Fin du jeu ! Scores finaux -> Vous : {scoreJoueur}, Ordinateur : {scoreOrdi}");