using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ClassLibraryBouteille
{
    public class Bouteille
    {
        //attributs
        private float contenanceEnLitre;       // en litres
        private float contenuEnLitre;          // eau, vin etc...
        private bool estOuverte;               // état de la bouteille

        //constructeurs

        //constructeur par defaut
        public Bouteille()
        {
            this.contenanceEnLitre = 1;
            this.contenuEnLitre = 1;
            this.estOuverte = false;
        }
        //constructeur classique
        public Bouteille(float contenenanceEnLitre,
                         float contenuEnLitre,
                         bool estOuverte)
        {
            this.contenanceEnLitre = contenenanceEnLitre;
            if(contenuEnLitre > contenanceEnLitre)
            {
                throw new ArgumentException("Erreur contenu supérieur à contenance");
            }
            this.contenuEnLitre = contenuEnLitre;
            this.estOuverte = estOuverte;
        }

        //constructeur hybride classique defaut
        public Bouteille(float contenenanceEnLitre,
            float contenuEnLitre)
            : this(contenenanceEnLitre, contenuEnLitre, false)
        {
        }
        //constructeur par clonage
        public Bouteille(Bouteille bouteilleACopier)
        {
            this.contenanceEnLitre = bouteilleACopier.contenanceEnLitre;
            this.contenuEnLitre = bouteilleACopier.contenuEnLitre;
            this.estOuverte = bouteilleACopier.estOuverte;
        }

        // Méthodes
        
        // Ouvrir la bouteille
        public bool Ouvrir()
        {
            if (!estOuverte)
            {
                this.estOuverte = true;
                return true;
            }
            else
            {
                return false;
            }
        }


        // Fermer la boutaille
        public bool Fermer() 
        {
            if (estOuverte) 
            {
                this.estOuverte = false;
                return true;
            }
            else 
            {
                return false;
            } 
        }

        // Remplir toute la bouteille
        public bool Remplir()
        {
            bool resultat;
            if (estOuverte)
            {
                contenuEnLitre = contenanceEnLitre;
                resultat = true;
            }
            else
            {
                resultat = false;
            }

            return resultat; 
        }

        // Vider toute la bouteille
        public bool Vider()
        {
            bool resultat;
            if (estOuverte)
            {
                contenuEnLitre = 0;
                resultat = true;
            }
            else 
            {
                resultat= false;
            }
            return resultat;
        }

        // Remplir la bouteille avec une quantité spécifique
        public bool Remplir(float quantiteEnL)
        {
           if (estOuverte) 
           {
                if (contenuEnLitre + quantiteEnL <= contenanceEnLitre) 
                {
                    contenuEnLitre += quantiteEnL;
                    return true;
                }
                else 
                {
                    return false;
                }
            }
           else 
            {
                return false;
            }
        }

        // Vider une quantité spécifique de la bouteille
        public bool Vider(float quantiteEnL)
        {
            if (estOuverte)
            {
                if (quantiteEnL > 0 && contenanceEnLitre - quantiteEnL >= 0)
                {
                    contenuEnLitre -= quantiteEnL;
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }



        public override string ToString()
        {
            return base.ToString() + " contenuEnLitre=" + contenuEnLitre + " contenuEnLitre="+ contenuEnLitre + " estOuverte=" + estOuverte;
        }
    }


    
}
