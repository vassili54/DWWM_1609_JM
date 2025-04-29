<?php

class Contribuable {

    // Attributs de la classe
    private string $nom;
    private float $revenuAnnuel;

    // Constantes pour les taux d'imposition
    private const TAUX_REDUIT = 0.09; // 9%
    private const TAUX_MAX = 0.14;    // 14%

    /**
     * Constructeur de la classe Contribuable.
     *
     * @param string $nom Le nom du contribuable.
     * @param float $revenuAnnuel Le revenu annuel du contribuable.
     */
    public function __construct(string $nom, float $revenuAnnuel) {
        $this->nom = $nom;
        $this->revenuAnnuel = $revenuAnnuel;
    }

    /**
     * Obtient le nom du contribuable.
     *
     * @return string
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Obtient le revenu annuel du contribuable.
     *
     * @return float
     */
    public function getRevenuAnnuel(): float {
        return $this->revenuAnnuel;
    }

    /**
     * Calcule et renvoie le montant de l'impôt sur le revenu.
     *
     * Le calcul se base sur deux tranches :
     * - Jusqu'à 15000 € : taxé à TAUX_REDUIT (9%)
     * - Au-delà de 15000 € : taxé à TAUX_MAX (14%)
     *
     * @return float Le montant de l'impôt.
     */
    public function calculerImpot(): float {
        $montantImpot = 0.0;
        $seuil = 15000.0;

        if ($this->revenuAnnuel <= $seuil) {
            // Revenu <= 15000€, taxé au taux réduit
            $montantImpot = $this->revenuAnnuel * self::TAUX_REDUIT;
        } else {
            // Revenu > 15000€
            // Partie du revenu jusqu'à 15000€ taxée au taux réduit
            $tranche1 = $seuil * self::TAUX_REDUIT;

            // Partie du revenu au-delà de 15000€ taxée au taux max
            $tranche2 = ($this->revenuAnnuel - $seuil) * self::TAUX_MAX;

            // Impôt total = somme des impôts sur chaque tranche
            $montantImpot = $tranche1 + $tranche2;
        }

        return $montantImpot;
    }
}

?>