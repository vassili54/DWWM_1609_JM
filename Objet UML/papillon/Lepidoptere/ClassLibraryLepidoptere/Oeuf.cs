using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ClassLibraryLepidoptere
{
    public class Oeuf : StadeDEvolution
    {
        //Constructeur
        public Oeuf()
        {

        }
        //Méthodes
        public override void SeDeplacer()
        {
            Console.WriteLine("Je peux pas");
        }

        
        public override StadeDEvolution SeMetamorphoser()
        {
            return new Chenille();
        }
       
    }
}
