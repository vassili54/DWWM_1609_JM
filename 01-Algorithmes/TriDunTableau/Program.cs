/*
 
Tri d’un tableau
Nous désignerons par a1, a2, …, aN les éléments d’un tableau à trier par ordre croissant.

Exemple: [128, 64, 8, 512, 16, 32, 256]

On commence par chercher l’indice du plus petit des éléments, soit j cet indice.

On permute alors les valeurs de a1 (128) et aj (8).

Le tableau devient [8, 64, 128, 512, 16, 32, 256].

On cherche ensuite l’indice du plus petit des éléments entre a2 et aN et on permute avec a2.

Le tableau devient [8, 16, 128, 512, 64, 32, 256].

On cherche ensuite l’indice du plus petit des éléments a3, a4, …, aN etc…
 
 */

//VARIABLES
int[] tab = new int[] { 128, 64, 8, 512, 16, 32, 256 };
int indiceJ = 0;
int temp;

for (int i = 0; i < tab.Length - 1; i++)
{
    indiceJ = i; // Trouver l'indice
    for (int j = i + 1; j < tab.Length; j++)
    {
        if (tab[j] < tab[indiceJ])
        {
            indiceJ = j;
        }
    }
    // Permuter les éléments
    temp = tab[i];
    tab[i] = tab[indiceJ];
    tab[indiceJ] = temp;
}

//Affichage
for (int j = 0; j < tab.Length; j++)
{
    Console.Write(tab[j] + " ");
}
