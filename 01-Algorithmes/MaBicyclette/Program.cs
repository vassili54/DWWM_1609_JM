/*
 Réalisez l’algorithme et le programme correspondant au texte ci-dessous :

S’il fait beau demain, j’irai faire une balade à bicyclette.

Je n’ai pas utilisé ma bicyclette depuis plusieurs mois, peut-être n’est-elle plus en parfait état de fonctionnement.

Si c’est le cas, je passerai chez le garagiste avant la balade. 
J’espère que les réparations seront immédiates sinon je devrai renoncer à la balade en bicyclette. 
Comme je veux de toute façon profiter du beau temps, si mon vélo n’est pas utilisable, 
j’irai à pied jusqu’à l’étang pour cueillir les joncs.

S’il ne fait pas beau, je consacrerai ma journée à la lecture. 
J’aimerais relire le 1er tome de Game of Thrones. 
Je pense posséder ce livre, il doit être dans la bibliothèque du salon.

Si je ne le retrouve pas, j’irai l’emprunter à la bibliothèque municipale. 
Si le livre n’est pas disponible, j’emprunterai un roman policier.

Je rentrerai ensuite directement à la maison.

Dès que j’aurai le livre qui me convient, 
je m’installerai confortablement dans un fauteuil et je me plongerai dans la lecture.
 */

//VARIABLES
string meteo, etatVelo, reparations, LivreDisponible, LivreEmprunte;

//TRAITEMENT
Console.WriteLine("Fait-il beau aujourd'hui ? (oui/non) : ");
meteo = Console.ReadLine().ToLower();

if (meteo == "oui")
{
    Console.WriteLine("Votre vélo est-il en bon état ? (oui/non)");
    etatVelo = Console.ReadLine().ToLower();

    if (etatVelo == "oui")
    {
        Console.WriteLine("J'irai faire une balade à bicyclette");
    }
    else
    {
        Console.WriteLine("Je passerai chez le garagiste avant la balade.");
        Console.WriteLine("Les réparations sont-elles immédiates ? (oui/non) : ");
        reparations = Console.ReadLine().ToLower();

        if (reparations == "oui")
        {
            Console.WriteLine("Les réparations sont imédiates, je peux faire ma balade à bicyclette.");
        }
        else
        {
            Console.WriteLine("Les réparations ne sont pas imédiates, je devrai renoncer à la balade en bicyclette.");
            Console.WriteLine("J'irai à pied jusqu'à l'étang pour cueillir les joncs.");
        }
    }
}
else
{
    Console.WriteLine("Je consacrerai ma journée à la lecture.");
    Console.WriteLine("Possédez-vous le 1er tome de Game of Thromes ? (oui/non) : ");
    LivreDisponible = Console.ReadLine().ToLower();

    if (LivreDisponible == "oui")
    {
        Console.WriteLine("Je relirai le 1er tome Game of Thrones.");
    }
    else
    {
        Console.WriteLine("Je ne trouve pas le livre, j'irai l'emprunter à la bibliothèque municipale.");
        Console.WriteLine("Le livre est-il disponible à la bibliothèque ? (oui/non) : ");
        LivreEmprunte = Console.ReadLine().ToLower();

        if (LivreEmprunte == "oui")
        {
            Console.WriteLine("J'ai emprunté le 1er tome de Game of Thrones.");
        }
        else
        {
            Console.WriteLine("Le livre n'est pas disponible, j'emprunterai un roman policier.");
        }
    }
    Console.WriteLine("Je rentrerai ensuite directement à la maison.");
    Console.WriteLine("Dès que j'aurai le livre qui me convient, je m'installerai confortablement dans un fauteuil et je me plongerai dans la lecture.");
}