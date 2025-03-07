using ClassLibraryBouteille;

namespace ConsoleAppBouteille
{
    internal class Program
    {
        static void Main(string[] args)
        {
            //Bouteille b;
            //b = new Bouteille();


            /*
            bool ok = b.Fermer();
            Console.WriteLine("retour ok "+ok);
            Console.WriteLine(b.ToString());
            */

            Bouteille b = new Bouteille(3f, 2f, false); // Instance nouvelle bouteille b

            /* Méthode Ouvrir
            bool testOuvrir = b.Ouvrir(); // Test Ouvrir() avec bouteille fermée
            b.Fermer();
            testOuvrir = b.Ouvrir(); // Test Ouvrir() avec bouteille ouverte
            */

            /* Méthode Fermer
            bool testFermer = b.Fermer(); // Test Fermer() avec bouteille fermée
            b.Ouvrir();
                testFermer = b.Fermer(); // Test Fermer() avec bouteille ouverte
            */

            /* Méthode Vider
            bool testVider = b.Vider(); //Test Vider() avec bouteille fermée
            b.Ouvrir();
            testVider = b.Vider(); //Test Vider() avec bouteille fermée
             
             */

            /* Méthode Remplir
             
            //bool testRemplir = b.Remplir(); //Test Remplir avec bouteille fermée
            b.Ouvrir();
            bool testRemplir = b.Remplir();

              */

            /* Méthode Remplir avec une quantité spécifique
            b.Ouvrir();
            b.Vider();
            bool testRemplir = b.Remplir(1.5f);

            */

            /* Méthode Remplir avec une quantité spécifique
             
            
             */

            b.Ouvrir();
            bool testVider = b.Vider(1.5f);
        }
    }
}
