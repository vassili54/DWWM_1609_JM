/*
Dénombrer les lettres de l’alphabet dans un tableau.

Lire un texte d’au moins 120 caractères (à contrôler).
Compter et afficher le nombre d’occurrences (d’apparitions)
de chacune des lettres de l’alphabet.

 */
//Initialiser un tableau pour compter les occurences des lettres
int[] lettrecount = new int[26];

//VARIABLES
string input;
int i;

Console.WriteLine("Veuillez entrer un texte d'au moins 120 caractères :");
input = Console.ReadLine();

//Verifier le texte contient 120 caractères
while (input.Length < 120)
{
    Console.WriteLine("Le texte doit contenir au moins 120 caractères. Veuillez réessayer :");
    input = Console.ReadLine();
}

//compter l'occurences de chaque lettre
foreach (char c in input.ToLower())
{
    if (char.IsLetter(c))
    {
        lettrecount[c - 'a']++;
    }
}
//Afficher les résultat
for (i = 0; i < lettrecount.Length; i++)
{
    Console.WriteLine($"{(char)(i + 'a')} : {lettrecount[i]}");
}
