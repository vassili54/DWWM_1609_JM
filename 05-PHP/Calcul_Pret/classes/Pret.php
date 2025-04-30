<?php
/**
 * Classe Pret - Modèle pour le calcul d'un prêt
 * Représente un prêt bancaire avec calcul de mensualité
 */
class Pret {
    // Propriétés privées pour encapsulation des données
    private $capital; // Montant total du prêt
    private $tauxAnnuel; // Taux d'intérêt annuel (en %)
    private $dureeAnnees; // Durée du prêt en années

    /**
    * Constructeur - Initialise les propriétés du prêt
    * @param float $capital
    * @param float $tauxAnnuel
    * @param int $dureeAnnees
    */
    public function __construct(float $capital, float $tauxAnnuel, int $dureeAnnees) {
        $this->capital = $capital;
        $this->tauxAnnuel = $tauxAnnuel;
        $this->dureeAnnees = $dureeAnnees;
    }
    /**
    * Calcule la mensualité constante du prêt
    * @return float Montant de la mensualité
    */
    public function calculMensualite(): float {
        // Conversion du taux annuel en taux mensuel décimal
        $tauxMensuel = $this->tauxAnnuel / 100 / 12;
        // Conversion de la durée en années en nombre de mois
        $nombreMois = $this->dureeAnnees * 12;
        // Cas particulier : prêt sans intérêt
        if ($tauxMensuel == 0) {
            return $this->capital / $nombreMois;
        }
        // Formule standard de calcul de mensualité :
        // M = (C×t)/(1-(1+t)^-n)
        // où C=capital, t=taux mensuel, n=nombre de mois
        return ($this->capital * $tauxMensuel) / (1 - pow(1 + $tauxMensuel, -$nombreMois));
    }
   
}

?>