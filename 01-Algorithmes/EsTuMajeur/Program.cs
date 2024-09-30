// variables
int age;
string saisieUser;

// Traitement
Console.Write("Entrez votre âge : ");
age = int.Parse(Console.ReadLine());

if (age < 0)
{
    Console.WriteLine("Vous n'êtes pas encore né(e)");
}
else if (age < 18)
{
    Console.WriteLine("Vous êtes mineur");
}
else
{
    Console.WriteLine("Vous êtes majeur");
}