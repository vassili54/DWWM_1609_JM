using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Cryptography.X509Certificates;
using System.Text;
using System.Threading.Tasks;

namespace ClassLibraryLepidoptere
{
    public class Chrysalide : StadeDEvolution 
    {
        public Chrysalide() 
        {
          
        }
        public override void SeDeplacer()
        {
            Console.WriteLine("Je peux pas");
        }
        public override StadeDEvolution SeMetamorphoser()
        {
            return new Papillon();
        }


    }
}
