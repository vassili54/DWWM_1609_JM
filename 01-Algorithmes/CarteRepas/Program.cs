/*
 Au CRM, chaque stagiaire et chaque membre du personnel dispose d’une carte à son nom. 
Pour régler les consommations avec la carte, il est nécessaire de l’alimenter en €. (Principe de la « carte prépayée »). 
Pour régler un repas au restaurant du CRM, la carte est vérifiée :
-Les données de la carte correspondent-elle à une personne enregistrée ?
-	Y’a-t-il suffisamment de fonds disponibles ?
Si les contrôles sont validés, le prix du repas est soustrait de la somme disponible sur la carte.

Votre travail consiste à développer l’algorithme de validation de la carte.

Pour simuler le fonctionnement, l’algorithme sera programmé dans une application en mode ‘Console’. 
-	Le tableau ‘utilisateurs’ contiendra 5 utilisateurs.
-	Le prix du repas sera fixé à 4 €
-	Il n’est pas possible d’être « à découvert »
*/


//VARIABLES
string[] noms = { "Guy Georges", "Emile Louis", "Heaulme Francis", "Weber Simone", "Fourniret Michel" };
string[] carteIDs = { "C1", "C2", "C3", "C4", "C5" };
double[] soldes = { 10, 5, 0, 20, 15 };

double prixRepas = 4.0;

Console.WriteLine("Bienvenue au CRM. Veuillez entrer votre carte ID:");
string carteID = Console.ReadLine();

// Vérification de la carte
int index = Array.IndexOf(carteIDs, carteID);

if (index != -1) // Carte trouvée
{
    Console.WriteLine("Bonjour " + noms[index] + ".");
    if (soldes[index] >= prixRepas) // Vérification du solde
    {
        soldes[index] -= prixRepas; // Débiter le prix du repas
        Console.WriteLine("Le repas de "+ prixRepas +" euro a été débité. Solde restant: "+ soldes[index] +" euro.");
    }
    else
    {
        Console.WriteLine("Fonds insuffisants sur la carte.");
    }
}
else
{
    Console.WriteLine("Carte non valide.");
}