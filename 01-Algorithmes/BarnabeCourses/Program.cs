/*
Barnabé fait ses courses.

Barnabé fait ses courses dans plusieurs magasins.
Dans chacun, il dépense 1 € de plus que la moitié de ce qu’il possédait en entrant.
Dans le dernier magasin, il dépense le solde.
Soit la somme S dont il disposait au départ (S > 1 €).
Représenter l’algorithme permettant de trouver le nombre de magasins dans lesquels il a acheté.
 */

//VARIABLES
int sommeInitiale = 0;
int sommeRestante;
int nombreMagasins = 0;

Console.Write("Entrez la somme initiale S (S > 1 €) : ");
sommeInitiale = int.Parse(Console.ReadLine());

if (sommeInitiale <= 1)
{
    Console.WriteLine("La somme initiale doit être supérieure à 1 €.");

}

while (sommeInitiale > 0)
{
    sommeRestante = sommeInitiale / 2 + 1;
    sommeInitiale = sommeInitiale - sommeRestante;
    nombreMagasins++;
}

Console.WriteLine("Barnabé a fait ses courses dans " + nombreMagasins + " magasins.");