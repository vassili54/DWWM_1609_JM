using MatzTools;

//VARIABLES
int A = ConsoleTools.DemanderNombreEntier("Entrer le nombre A");
int B = ConsoleTools.DemanderNombreEntier("Entrer le nombre B");
int C = ConsoleTools.DemanderNombreEntier("Entrer le nombre C");
float D = ConsoleTools.DemanderNombreFlottant("Entrer le flottant D");
int[] nombres;


/* Lire les trois nombres entiers
Console.Write("Entrez le nombre A : ");
int A = int.Parse(Console.ReadLine());

Console.Write("Entrez le nombre B : ");
int B = int.Parse(Console.ReadLine());

Console.Write("Entrez le nombre C : ");
int C = int.Parse(Console.ReadLine());
*/

nombres = [A, B, C];

Array.Sort(nombres);

// AFFICHAGE
for (int i = 0; i < nombres.Length; i++)
{
    Console.WriteLine(nombres[i]);
}

Console.WriteLine("Nombre flottant D: " + D);

Console.ReadLine();