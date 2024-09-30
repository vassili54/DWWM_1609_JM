/*
Jeu de la fourchette

1.L’ordinateur « choisit » aléatoirement un nombre mystère (entier compris entre 0 et 100).

2.Le joueur essaie de le deviner.
Lors de chaque essai, l’ordinateur affiche la « fourchette » dans laquelle se trouve le nombre qu’il a choisi.

Le choix du nombre mystère sera simulé par génération d’un nombre aléatoire : N <-- RANDOM(0,100).
Lorsque l’utilisateur a trouvé le nombre mystère, le programme affiche :
Bravo vous avez trouvé en X essais.
 */

//VARIABLES
int nombreMystere;
int nbEssais;
int essai;
Boolean trouve = false;

//DEBUT DU PROGRAMME
Random random = new Random();
nombreMystere = random.Next(0, 101);
nbEssais = 0;

Console.WriteLine("Bienvenue au jeu de la fourchette !");
Console.WriteLine("L'ordinateur a choisi un nombre entre 0 et 100. À vous de le deviner.");

while (!trouve) 
{ 
    Console.Write("Entrez votre essai :");
    essai = int.Parse(Console.ReadLine());
    nbEssais++;

    if (essai < nombreMystere)
    {
        Console.WriteLine("C'est plus !");
    }
    else if (essai > nombreMystere)
    {
        Console.WriteLine("C'est moins !");
    }
    else 
    {
       trouve = true;
        Console.WriteLine("Bravo, vous avez trouvé le nombre mystère en " + nbEssais + " essais !");
    }
}