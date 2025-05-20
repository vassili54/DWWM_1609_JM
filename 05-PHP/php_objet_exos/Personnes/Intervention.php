<?php
require_once './Client.php';
require_once './Intervenant.php';

class Intervention {
    private Client $client;
    private Intervenant $intervenant;
    private DateTime $dateHeure;
    private string $description;

    public function __construct(Client $client, Intervenant $intervenant) {
        $this->client = $client;
        $this->intervenant = $intervenant;
        $this->dateHeure = new DateTime();
    }

    public function setDetails(DateTime $dateHeure, string $description): void {
        $this->dateHeure = $dateHeure;
        $this->description = $description;
    }

    public function getDetails(): array {
        return [
            'client' => $this->client->getNomComplet(),
            'intervenant' => $this->intervenant->getNomComplet(),
            'date' => $this->dateHeure->format('d/m/Y H:i'),
            'description' => $this->description
        ];
    }
}