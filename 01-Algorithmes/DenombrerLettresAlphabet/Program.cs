/*
Dénombrer les lettres de l’alphabet dans un tableau.

Lire un texte d’au moins 120 caractères (à contrôler).
Compter et afficher le nombre d’occurrences (d’apparitions)
de chacune des lettres de l’alphabet.

 */

// Déclaration des variables
string EntrerTexte;
Dictionary < char, int> dict = new Dictionary<char, int>();// Initialiser un dictionnaire pour compter les occurrences des lettres

//TRAITEMENT
Console.WriteLine("Entrer un texte d'au moins 120 caractères :");
EntrerTexte = Console.ReadLine();

while (EntrerTexte.Length < 120) // Vérifier que le texte contient au moins 120 caractères
{
    Console.WriteLine("Le texte doit contenir au moins 120 caractères. Veuillez réessayer :");
    EntrerTexte = Console.ReadLine();
}

foreach (char c in EntrerTexte.ToLower()) // Compter les occurrences de chaque lettre
{
    if (char.IsLetter(c))
    {
        if (dict.ContainsKey(c))
        {
            dict[c]++;
        }
        else
        {
            dict[c] = 1;
        }
    }
}

// Afficher les résultats
Console.WriteLine("Nombre d'occurrences de chaque lettre :");
foreach (var (key, value) in dict)// Compter les occurrences de chaque lettre
{
    Console.WriteLine(key + " : " + value);
}
