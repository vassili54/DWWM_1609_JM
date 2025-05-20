<?php
require_once('./Moteur.php');
require_once('./Voiture.php');

/**
 * @author JMatz
 * @version 1.0
 * @created 13-mai-2025 12:17:54
 */
class VoitureDeCourse extends Voiture
{
    /**
     * Constructeur de VoitureDeCourse
     * @param string $marque Marque de la voiture
     * @param string $modele Modèle de la voiture
     * @param $moteur Moteur de la voiture
     * @param int $poids Poids en kg (défaut: 1000)
     */
    public function __construct(string $marque, string $modele, int $poids = 1000, string $marqueMoteur, int $vitesseMax)
    {
        if ($marque !== $marqueMoteur) {
            throw new Exception("La marque de la voiture de course doit correspondre à celle du moteur");
        } else {
            parent::__construct($marque, $modele, $poids, $marqueMoteur, $vitesseMax);
        }
    }

    /**
     * Vérifie que le moteur est de la même marque que la voiture
     * @param Moteur $moteur Le moteur à associer
     * @throws Exception Si la marque du moteur ne correspond pas
     */
    public function setMoteurVDC(string $marqueMoteur, int $vitesseMax): void
    {
        if ($marqueMoteur !== $this->getMarque()) {
            throw new Exception("Une voiture de course n'accepte que des moteurs de la même marque");
        } else {
          parent::setMoteur( new Moteur($vitesseMax, $marqueMoteur));
        }
    }

    /**
     * Retourne les informations complètes de la voiture de course
     * @return string Ex: "Renault F1, 450 Kg. Vitesse max : 317km/h"
     */
    public function afficher(): string
    {
        return parent::afficher() . ". Vitesse max : " . $this->vitesseMax() . "km/h";
    }

    /**
     * Calcule la vitesse max spécifique aux voitures de course
     * @return float Vitesse maximale en km/h
     */
    public function vitesseMax(): float
    {
        return $this->getMoteur()->getVitesseMax() - ($this->getPoids() * 0.05);
    }
}
