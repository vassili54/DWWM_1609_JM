/*
L’utilisateur peut saisir des noms de légumes. Pour chaque légume, l’utilisateur précise un prix au kilo.

Exemple : “carottes 2.99”

Lorsque l’utilisateur saisit la valeur “go”, le programme affiche la liste des légumes avec leur prix ainsi que le légume le moins cher.

Exemple :

1 kilogramme de carottes coute 2.99 euros.  
1 kilogramme de poireaux coute 1.99 euros.
[...]
Légume le moins cher au kilo : poireaux
 */

//VARIABLES
using System.Threading.Channels;

Dictionary<string, double> legumes = new Dictionary<string, double>();//Dictionnaire pour stoker les légumes et leurs prix
string entrer;

Console.WriteLine("Entrez des légumes et leur prix au kilo (ex carottes 2.99). Tapez 'go' pour terminer");

while (true) 
{
    entrer = Console.ReadLine();
    
}