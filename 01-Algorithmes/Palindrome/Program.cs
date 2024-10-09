/*
Un palindrome est une chaîne de caractères que l’on peut lire identiquement de droite à gauche, et gauche à droite.

Par exemple:

AA
38783
LAVAL
LAVAL A ETE A LAVAL
ET LA MARINE VA VENIR A MALTE
L’utilisateur saisit une chaîne de caractères terminée par un point . (à contrôler).

Ecrivez l’algorithme et le programme permettant d’affirmer si cette phrase est ou non un palindrome.

Si la chaîne de caractères n’est composée que du caractère ‘.’, l’utilisateur est invité à recommencer.

L’algorithme doit prévoir les 3 cas suivants :

la phrase est vide
la chaîne de caractères n’est pas un palindrome
la chaîne de caractères est un palindrome
*/

//VARIABLES
Boolean isPalindrome;
string phrase;

do
{
    Console.Write("Entrez une phrase terminée par un point : ");
    phrase = Console.ReadLine();

    // Supprimer le point final
    phrase = phrase.TrimEnd('.');

    // Vérifier si la phrase est vide
    if (string.IsNullOrEmpty(phrase))
    {
        Console.WriteLine("La phrase est vide. Veuillez réessayer.");
        continue;
    }

    // Supprimer les espaces et convertir en minuscules pour une comparaison plus simple
    phrase = phrase.Replace(" ", "").ToLower();

    // Comparer la phrase avec sa version inversée
    isPalindrome = phrase == new string(phrase.Reverse().ToArray());

    if (isPalindrome)
    {
        Console.WriteLine("La phrase est un palindrome.");
    }
    else
    {
        Console.WriteLine("La phrase n'est pas un palindrome.");
    }
} while (string.IsNullOrEmpty(phrase));
