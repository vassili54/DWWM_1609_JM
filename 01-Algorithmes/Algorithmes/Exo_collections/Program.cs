/*
 Implémenter le programme suivant : 

Au démarrage, il n'y a aucun utilisateur enregistré.

## Déroulement du programme

1. Le programme demande à l'utilisateur de saisir un nom et un prénom.
      - L’utilisateur saisit un nom et un prénom.

2. Le programme demande à l'utilisateur de saisir la date de naissance.
      - L'utilisateur saisit la date de naissance.

3. Le programme calcule l'âge de la personne en cours d'ajout.
      - Si l’âge est supérieur ou égal à 18 (majeur)
            - Le programme demande à l'utilisateur de saisir son métier.
      - Si l’âge est inférieur à 18 (mineur)
            - Le programme demande à l'utilisateur de saisir sa couleur préférée.

4. Lorsque toutes les informations sont saisies
      - Le programme enregistre l'utilisateur

5. Le programme demande à l'utilisateur s'il souhaite ajouter une autre personne.
      - Si oui
            - Retour à l'étape 1 (saisir nom et prénom)
      - Si non
            - Afficher tous les utilisateurs enregistrés en respectant ce format :
            - Nom Prénom - Date de naissance (âge) - Métier/Couleur préférée

6. Le programme remercie l'utilisateur et se termine
 */


/*

List<string> utilisateurs = new List<string>();
        Boolean continuer = true;

        while (continuer)
        {
            Console.WriteLine("Saisissez votre nom :");
            string nom = Console.ReadLine();
            Console.WriteLine("Saisissez votre prénom :");
            string prenom = Console.ReadLine();

            Console.WriteLine("Saisissez votre date de naissance (jj/mm/aaaa) :");
            DateTime dateNaissance;
            
            //Tente de convertir la chaîne saisie en un objet
            while (!DateTime.TryParseExact(Console.ReadLine(), "dd/MM/yyyy", null, System.Globalization.DateTimeStyles.None, out dateNaissance))
            {
                Console.WriteLine("Format de date invalide. Veuillez saisir votre date de naissance (jj/mm/aaaa) :");
            }
            //Déclare une variable pour stocker la date de naissance.
            int age = DateTime.Now.Year - dateNaissance.Year;
            if (dateNaissance > DateTime.Now.AddYears(-age)) age--;

            string infoSupplementaire;

            if (age >= 18)
            {
                Console.WriteLine("Saisissez votre métier :");
                string metier = Console.ReadLine();
                infoSupplementaire = metier;
            }
            else
            {
                Console.WriteLine("Saisissez votre couleur préférée :");
                string couleurPreferee = Console.ReadLine();
                infoSupplementaire = couleurPreferee;
            }

            utilisateurs.Add($"{nom} {prenom} - {dateNaissance:dd/MM/yyyy} ({age}) - {infoSupplementaire}");

            Console.WriteLine("Souhaitez-vous ajouter une autre personne ? (oui/non)");
            string reponse = Console.ReadLine().ToLower();
            continuer = reponse == "oui";
        }

        Console.WriteLine("\nUtilisateurs enregistrés :");
        foreach (var utilisateur in utilisateurs)
        {
            Console.WriteLine(utilisateur);
        }

        Console.WriteLine("Merci et à bientôt !");
*/

// Liste pour stocker les utilisateurs
List<string> utilisateurs = new List<string>();
string addUtilisateurs;

do
{
    // Variables
    string nom, prenom, dateNaissanceString, favoriteCouleur;
    DateTime dateNaissance;
    int age;

    // Demander le nom
    Console.WriteLine("Veuillez saisir le nom:");
    nom = Console.ReadLine();
    // Demander le prénom
    Console.WriteLine("Veuillez saisir le prénom:");
    prenom = Console.ReadLine();
    // Demander la date de naissance
    Console.WriteLine("Veuillez saisir la date de naissance (aaaa-mm-jj):");
    dateNaissanceString = Console.ReadLine();
    dateNaissance = DateTime.Parse(dateNaissanceString);

    // Calculer l'âge de l'utilisateur
    age = DateTime.Now.Year - dateNaissance.Year;

    // Demander le métier ou la couleur préférée en fonction de l'âge
    if (age >= 18)
    {
        Console.WriteLine("Veuillez saisir le métier:");
        favoriteCouleur = Console.ReadLine();
        utilisateurs.Add($"{prenom} {nom} - {dateNaissance.ToShortDateString()} ({age}) - Métier: {favoriteCouleur}");
    }
    else
    {
        Console.WriteLine("Veuillez saisir votre couleur préférée:");
        favoriteCouleur = Console.ReadLine();
        utilisateurs.Add($"{prenom} {nom} - {dateNaissance.ToShortDateString()} ({age}) - Couleur préférée: {favoriteCouleur}");
    }

    // Demander si l'utilisateur souhaite ajouter une autre personne
    Console.WriteLine("Voulez-vous ajouter une autre personne? (oui/non)");
    addUtilisateurs = Console.ReadLine().ToLower();

} while (addUtilisateurs == "oui");

// Affichage
Console.WriteLine("Liste des utilisateurs enregistrés:");
foreach (var user in utilisateurs)
{
    Console.WriteLine(user);
}


Console.WriteLine("Merci d'avoir utilisé ce programme!");
