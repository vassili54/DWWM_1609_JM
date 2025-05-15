<?php


/**
 * @author JMatz
 * @version 1.0
 * @created 13-mai-2025 12:14:39
 */
class Moteur
{

	private string $marque;
	private int $vitesseMax;
	private ?Voiture $voiture = null; // Un moteur peut être sans voiture


    /**
     * Constructeur de la classe Moteur
     * @param string $marque Marque du moteur
     * @param int $vitesseMax Vitesse maximale en km/h
     */

	public function __construct(int $vitesseMax, string $marque)
	{
		$this->marque =$marque;
		$this->vitesseMax = $vitesseMax;
	}

	//getters
	public function getmarque(): string
	{
		return $this->marque;
	}

	public function getvitesseMax(): int
	{
		return $this->vitesseMax;
	}

	/**
	 * 
	 * @param vitesseMax
	 */
	public function setvitesseMax($vitesseMax): void
	{
		$this->vitesseMax = $vitesseMax;
	}

	/**
     * Lie ce moteur à une voiture
     * @param Voiture|null $voiture La voiture à associer (null pour dissocier)
     */
    public function setVoiture(?Voiture $voiture): void
    {
        $this->voiture = $voiture;
    }

}
?>