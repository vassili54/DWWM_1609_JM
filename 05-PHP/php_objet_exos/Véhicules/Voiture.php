<?php
require_once ('./Moteur.php');

/**
 * @author JMatz
 * @version 1.0
 * @created 13-mai-2025 11:10:47
 */
class Voiture
{

	private string $modele;
	private string $marque;
	private int $poids = 1000;
	private Moteur $moteur;
	

    /**
     * Constructeur de la classe Voiture
     * @param string $marque Marque de la voiture
     * @param string $modele Modèle de la voiture
     * @param Moteur $moteur Moteur de la voiture
     * @param int $poids Poids en kg (défaut: 1000)
     */
	public function __construct(string $marque, string $modele, int $poids = 1000, string $marqueMoteur, int $vitesseMax)
	{ 
		$this->marque = $marque;
		$this->modele = $modele;
		$this->poids = $poids;
		$this->moteur = new Moteur($marqueMoteur, $vitesseMax);
		
	}



	// Getters
	public function getMarque(): string
	{
		return $this->marque;
	}

	public function getModele(): string
	{
		return $this->modele;
	}

	public function getPoids(): int
	{
		return $this->poids;
	}
	
	public function getMoteur(): Moteur
    {
        return $this->moteur;
    }

	// Setters
	public function setPoids(int $poids): void
	{
		$this->poids = $poids;
	}
	
	public function setMoteur(Moteur $moteur): void
    {
        $this->moteur = $moteur;
       
    }

	/**
    * Retourne les informations de la voiture sous forme de chaîne
    * @return string Ex: "Renault Mégane, 750 Kg"
    */


	public function afficher(): string
	{
		return $this->marque . " " . $this->modele . ", " . $this->poids . " Kg";
	}

    /**
    * Calcule et retourne la vitesse maximale de la voiture
    * @return float Vitesse maximale en km/h
    */

	public function vitesseMax(): float
	{
		return $this->moteur->getvitesseMax() - ($this->poids * 0.3);
	}

}
?>