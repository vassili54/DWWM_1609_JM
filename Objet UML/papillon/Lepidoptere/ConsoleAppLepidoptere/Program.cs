using ClassLibraryLepidoptere;

namespace ConsoleAppLepidoptere
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Lepidoptere Lepi;
            Lepi = new Lepidoptere("bombyx");
            Lepi.SeDeplacer();

            Lepi.SeMetamorphoser();

            Lepi.SeDeplacer();

            int i = 0;
        }
    }
}




