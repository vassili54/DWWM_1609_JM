        // See https://aka.ms/new-console-template for more information
        Console.WriteLine("Tri de Nombres ++");

        // VARIABLES
        
        int A;
        int B;
        int min;
        int max;
        string saisieUtilisateur;

        // TRAITEMENT
        Console.WriteLine("Entrez le nombre A : ");
        saisieUtilisateur = Console.ReadLine(); // récuperation d'une saisie utilisateur
        A = int.Parse(saisieUtilisateur); // Conversion de la saisie en nombre entier

        Console.WriteLine("Entrez le nombre B : ");
        saisieUtilisateur = Console.ReadLine();
        B = int.Parse(saisieUtilisateur);

        //AFFICHAGE

        if (A <= B )
        {
            min = A;
            max = B;
        }
        else
        {
            min = B;
            max = A;
        }


        Console.WriteLine("Les nombres dans l'ordre croissant sont : ");
        Console.WriteLine(min);
        Console.WriteLine(max);

        Console.ReadLine();

        
