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
     * Génère un tableau HTML d'amortissement avec :
     * - Numéro du mois
     * - Part intérêts
     * - Part amortissement
     * - Capital restant dû
     */
    public function tableauAmortissement(): string {
        $mensualite = $this->calculMensualite();
        $tauxMensuel = $this->tauxAnnuel / 100 / 12;
        $capitalRestant = $this->capital;

        $html = <<<HTML
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Mois</th>
                    <th>Intérêt</th>
                    <th>Amortissement</th>
                    <th>Capital restant</th>
                </tr>
            </thead>
            <tbody>
        HTML;

        // Calcul et génération des lignes du tableau
        for ($mois = 1; $mois <= $this->dureeAnnees * 12; $mois++) {
            $interet = $capitalRestant * $tauxMensuel;
            $amortissement = $mensualite - $interet;
            $capitalRestant -= $amortissement;

            $html .= sprintf(
               '<tr><td>%d</td><td>%.2f €</td><td>%.2f €</td><td>%.2f €</td></tr>',
               $mois,
               $interet,
               $amortissement,
               max($capitalRestant, 0) // Assure que le capital restant ne soit pas négatif
            );

            if ($capitalRestant <= 0) break;
        }

        return $html .= '</tbody></table>';
        
    }

    /**
     * Retourne les données d'amortissement sous forme de tableau
     * Structure : [
     *     ['mois' => 1, 'interet' => X, 'amortissement' => Y, 'capital_restant' => Z],
     *     ...
     * ]
     */
    public function getTableauAmortissement(): array {
        $data = [];
        $mensualite = $this->calculMensualite();
        $tauxMensuel = $this->tauxAnnuel / 100 / 12;
        $capitalRestant = $this->capital;

        for ($mois = 1; $mois <= $this->dureeAnnees * 12; $mois++) {
            $interet = $capitalRestant * $tauxMensuel;
            $amortissement = $mensualite - $interet;
            $capitalRestant -= $amortissement;

            $data[] = [
                'mois' => $mois,
                'interet' => round($interet, 2),
                'amortissement' => round($amortissement, 2),
                'capital_restant' => max(round($capitalRestant, 2), 0)
            ];

            if ($capitalRestant <= 0) break;
        }

        return $data;
    }
}
?>