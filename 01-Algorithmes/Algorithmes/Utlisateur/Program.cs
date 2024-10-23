using System.Runtime.CompilerServices;
using Utlisateur;

namespace Utlisateur
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Enregistrement d'utilisateurs (gestion avec Objet Métier).");

            //Variable
            string saisieNomPrenom;
            string saisieDate;
            string? metierCouleur = null;
            ConsoleKey continuerO_N;
            List<Utilisateur> utilisateurs = new();

            //Traitement
            do
            {

                try
                {
                    Console.WriteLine("Saisissez le nom et Prénom.");
                    saisieNomPrenom = Console.ReadLine();

                    Console.WriteLine("Saisissez la date de naissane, jour/mois/année.");
                    saisieDate = Console.ReadLine();

                    Utilisateur unUtilisateur = new Utilisateur(saisieNomPrenom, saisieDate);

                    if (unUtilisateur.IsMajeur())
                    {
                        Console.WriteLine("Votre metier ?");
                        metierCouleur = Console.ReadLine();
                        unUtilisateur.SetMetier(metierCouleur);
                    }
                    else
                    {
                        Console.WriteLine("couleur préféré ?");
                        metierCouleur = Console.ReadLine();
                        unUtilisateur.SetCouleurPreferee(metierCouleur);
                    }


                    utilisateurs.Add(unUtilisateur);
                }
                catch (Exception ex)
                {
                    Console.WriteLine(ex.Message);
                }

                Console.WriteLine("Voulez vous saisir un autre utilisateur : N/O ?");

                continuerO_N = Console.ReadKey(true).Key;
            }
            while (continuerO_N == ConsoleKey.O);


            // Affichage de la liste des utilisateurs

            // List<Utilisateur]> utilisateurs = new();
            foreach (Utilisateur utilisateur in utilisateurs)
            {
                Console.Write("Nom et Prénom : " + utilisateur.GetNomComplet() + " - ");

                Console.Write(
                    "Date de naissance (âge): " +
                    utilisateur.GetDateDeNaissance() +
                    " (" + utilisateur.GetAge() + ") - "
                    );

                Console.WriteLine(utilisateur.GetCouleurOuMetier());


            }




            /*List<Utilisateur> resultat = utilisateurs.FindAll(u => u.IsMajeur() && u.GetDateDeNaissance() == DateTime.Now.ToShortDateString());

            foreach (Utilisateur u in utilisateurs)
            {
                if(u.IsMajeur() && u.GetDateDeNaissance() == DateTime.Now.ToShortDateString())
                {
                    resultat.Add(u);
                }
            }*/
        }
    }

}