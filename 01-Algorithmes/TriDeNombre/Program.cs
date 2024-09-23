using System;
					
public class Program
{
	public static void Main()
	{
		 // Lire les trois nombres entiers
        Console.Write("Entrez le nombre A : ");
        int A = int.Parse(Console.ReadLine());

        Console.Write("Entrez le nombre B : ");
        int B = int.Parse(Console.ReadLine());

        Console.Write("Entrez le nombre C : ");
        int C = int.Parse(Console.ReadLine());

        // Trouver le plus petit, le moyen et le plus grand
        int min, mid, max;

        if (A <= B && A <= C)
        {
            min = A;
            if (B <= C)
            {
                mid = B;
                max = C;
            }
            else
            {
                mid = C;
                max = B;
            }
        }
        else if (B <= A && B <= C)
        {
            min = B;
            if (A <= C)
            {
                mid = A;
                max = C;
            }
            else
            {
                mid = C;
                max = A;
            }
        }
        else
        {
            min = C;
            if (A <= B)
            {
                mid = A;
                max = B;
            }
            else
            {
                mid = B;
                max = A;
            }
        }

        // Afficher les nombres dans l'ordre croissant
        Console.WriteLine("Les nombres dans l'ordre croissant sont : ");
        Console.WriteLine(min);
        Console.WriteLine(mid);
        Console.WriteLine(max);
	}
}