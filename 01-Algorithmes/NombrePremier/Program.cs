/* 
Nombre premier
Lire un nombre N et déterminer s’il est un nombre premier.
Un nombre premier n’est divisible que par 1 et par lui-même.
*/

//VARIABLES
int nombre;
int i;
bool estPremier;

Console.Write("Entrez un nombre entier : ");
nombre = int.Parse(Console.ReadLine());

estPremier = true;

for (i = 2; i <= Math.Sqrt(nombre); i++)
{
    if (nombre % i == 0)
    {
        estPremier = false;
        break;
    }
}

if (estPremier)
{
    Console.WriteLine("{0} est un nombre premier.", nombre);
}
else
{
    Console.WriteLine("{0} n'est pas un nombre premier.", nombre);
}