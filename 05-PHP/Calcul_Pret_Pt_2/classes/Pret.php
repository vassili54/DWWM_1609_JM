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
    /**
    * Génère le tableau d'amortissement au format HTML
    * @return string Tableau HTML du plan d'amortissement
    */
    public function tableauAmortissement(): string {
        $mensualite = $this->calculMensualite();
        $tauxMensuel = $this->tauxAnnuel / 100 / 12;
        $capitalRestant = $this->capital;
        $html = '';

        // En-tête du tableau
        $html .= '<table class="table table-bordered table-striped">';
        $html .= '<thead class="thead-dark"><tr>';
        $html .= '<th>Numéro de mois</th>';
        $html .= '<th>Intérêt</th>';
        $html .= '<th>Amortissement</th>';
        $html .= '<th>Capital restant dû</th>';
        $html .= '</tr></thead><tbody>';

        // Calcul et génération des lignes du tableau
        for ($mois = 1; $mois <= $this->dureeAnnees * 12; $mois++) {
            $interet = $capitalRestant * $tauxMensuel;
            $amortissement = $mensualite - $interet;
            $capitalRestant -= $amortissement;

            // Formatage des nombres pour l'affichage
            $interetFormate = number_format($interet, 2, ',', ' ');
            $amortissementFormate = number_format($amortissement, 2, ',', ' ');
            $capitalRestantFormate = number_format(max($capitalRestant, 0), 2, ',', ' ');

            $html .= '<tr>';
            $html .= '<td>' . $mois . '</td>';
            $html .= '<td>' . $interetFormate . ' €</td>';
            $html .= '<td>' . $amortissementFormate . ' €</td>';
            $html .= '<td>' . $capitalRestantFormate . ' €</td>';
            $html .= '</tr>';

            // Arrêt si le capital est entièrement remboursé
            if ($capitalRestant <= 0) break;
        }

        $html .= '</tbody></table>';
        return $html;
    }

   /**
    * Génère le tableau d'amortissement sous forme de tableau associatif
    * @return array Tableau d'amortissement réutilisable
    */
    public function getTableauAmortissement(): array {
        $mensualite =$this->calculMensualite();
        $tauxMensuel = $this->tauxAnnuel / 100 / 12;
        $capitalRestant = $this->capital;
        $tableau = [];

        // Calcul des données pour chaque mois
        for ($mois = 1; $mois <= $this->dureeAnnees * 12; $mois++) {
            $interet = $capitalRestant * $tauxMensuel;
            $amortissement = $mensualite - $interet;
            $capitalRestant -= $amortissement;

            $tableau[] = [
                'mois' => $mois,
                'interet' => round($interet, 2),
                'amortissement' => round($amortissement, 2),
                'capital_restant' => max(round($capitalRestant, 2), 0),
            ];

            // Arrêt si le capital est entièrement remboursé
            if ($capitalRestant <= 0) break;
        }

        return $tableau;
        
    }
}

?>