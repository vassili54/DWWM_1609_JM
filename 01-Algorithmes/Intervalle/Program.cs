/*
Intervalle entre 2 nombres.
Lire 2 nombres entier A et B puis afficher tous les nombres entier dans l’intervalle.

Exemples : 
A = 3
B = 7
Résultat = 4 5 6

A = 7
B = 3
Résultat = 6 5 4
    */

// VARIABLES
int A, B;
int i;

Console.WriteLine("Entrez le premier nombre entier (A) :");
A = int.Parse(Console.ReadLine());

Console.WriteLine("Entrez le deuxième nombre entier (B) :");
B = int.Parse(Console.ReadLine());

Console.Write("Résultat = ");

if (A < B)
{
    for (i = A + 1; i < B; i++)
    {
        Console.Write(i + " ");
    }
}
else
{
    for (i = A - 1; i > B; i--)
    {
        Console.Write(i + " ");
    }
}
