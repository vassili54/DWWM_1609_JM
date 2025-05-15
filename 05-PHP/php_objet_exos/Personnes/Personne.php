<?php
class Personne
{
    private string $nom;
    private string $prenom;
    private DateTime $dateNaissance;

    public function __construct(string $nom, string $prenom, DateTime $dateNaissance)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getAge(): int
    {
        $now = new DateTime();
        $interval = $this->dateNaissance->diff($now);
        return $interval->y;
    }

    public function getNomComplet(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function setNom(string $nouveauNom): void
    {
        $this->nom = $nouveauNom;
    }
}
