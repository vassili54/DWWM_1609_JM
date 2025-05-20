<?php
require_once './Personne.php';

class Intervenant extends Personne {
    private float $salaire = 0;
    private float $autresRevenus = 0;

    public function setRevenus(float $salaire, float $autresRevenus): void {
        $this->salaire = $salaire;
        $this->autresRevenus = $autresRevenus;
    }

    public function calculerCharges(): float {
        $tauxSalaire = $this->getAge() > 55 ? 0.10 : 0.20;
        $tauxAutres = $this->getAge() > 55 ? 0.075 : 0.15;
        
        return ($this->salaire * $tauxSalaire) + ($this->autresRevenus * $tauxAutres);
    }
}