<?php
require_once './Personne.php';
require_once './Adresse.php';

class Client extends Personne {
    private string $numeroClient;
    private Adresse $adresse; // Référence obligatoire

    public function __construct(
        string $nom, 
        string $prenom, 
        DateTime $dateNaissance,
        string $numeroClient,
        int $numeroRue, 
        string $rue, 
        string $codePostal, 
        string $ville
    ) {
        parent::__construct($nom, $prenom, $dateNaissance);
        $this->numeroClient = $numeroClient;
        $this->adresse = new Adresse($numeroRue, $rue, $codePostal, $ville); // Composition
    }

    public function getAdresse(): Adresse {
        return $this->adresse;
    }
}


?>