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


List<(string Nom, double Prix)> legumes = new List<(string, double)>();
string input;

Console.WriteLine("Saisissez des légumes avec leur prix au kilo (ex: carottes 2.99). Tapez 'go' pour terminer.");

while (true)
{
    input = Console.ReadLine();

    if (input.ToLower() == "go")
        break;

    var parts = input.Split(' ');
    if (parts.Length == 2 && double.TryParse(parts[1], out double prix))
    {
        legumes.Add((parts[0], prix));
    }
    else
    {
        Console.WriteLine("Format invalide. Veuillez saisir un légume et son prix au kilo (ex: carottes 2.99).");
    }
}

Console.WriteLine("\nListe des légumes et leurs prix :");
string legumeMoinsCher = null;
double prixMoinsCher = double.MaxValue;

foreach (var legume in legumes)
{
    Console.WriteLine($"1 kilogramme de " + legume.Nom + " coûte " + legume.Prix + " euros.");
    if (legume.Prix < prixMoinsCher)
    {
        prixMoinsCher = legume.Prix;
        legumeMoinsCher = legume.Nom;
    }
}

if (legumeMoinsCher != null)
{
    Console.WriteLine($"Légume le moins cher au kilo : " + legumeMoinsCher +" ");
}


/*
string légume = "";
double prixLégume = 0;
string légumeMoinsCher = "";
double prixMin = double.MaxValue;

while (true)
{
    Console.WriteLine("Saisissez un légume et son prix au kilo (ou tapez 'go' pour terminer) :");
    string entrée = Console.ReadLine();

    if (entrée.ToLower() == "go")
        break;

    string[] parts = entrée.Split(' ');
    if (parts.Length == 2 && double.TryParse(parts[1], out prixLégume))
    {
        légume = parts[0];
        Console.WriteLine($"1 kilogramme de " + légume + " coûte " + prixLégume + " euros.");

        if (prixLégume < prixMin)
        {
            prixMin = prixLégume;
            légumeMoinsCher = légume;
        }
    }
    else
    {
        Console.WriteLine("Entrée invalide. Veuillez saisir au format 'légume prix'.");
    }
}

if (!string.IsNullOrEmpty(légumeMoinsCher))
{
    Console.WriteLine($"Légume le moins cher au kilo : " + légumeMoinsCher + " ");
}
*/