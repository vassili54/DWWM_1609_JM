/*
Rechercher un nombre dans un tableau

Soit un tableau de nombres entier triés par ordre croissant.
Exemple: [8, 16, 32, 64, 128, 256, 512]
Chercher si un nombre donné N figure parmi les éléments.
Si oui, afficher la valeur de l’indice correspondant. 
Sinon, afficher « Nombre non trouvé ».Rechercher un nombre dans un tableau
*/

//VARIABLES
int[] tab = { 8, 16, 32, 64, 128, 256, 512 };
int nombre;
int i;
Boolean trouve;

Console.Write("Entrez le nombre à chercher : ");
nombre = int.Parse(Console.ReadLine());

trouve = false;
for (i = 0; i < tab.Length; i++) 
{
    if (tab[i] == nombre)
    {
        Console.WriteLine("Le nombre " + nombre + " se trouve à l'indice " + i + ".");
        trouve = true;
        break;
    }
}

if (!trouve) 
{ 
    Console.WriteLine("nombre non trouvé.");
}