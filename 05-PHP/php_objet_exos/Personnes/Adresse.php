<?php
class Adresse {
    public function __construct(
        private int $numero,
        private string $rue,
        private string $codePostal,
        private string $ville
    ) {}

    public function getFullAdresse(): string {
        return "{$this->numero} {$this->rue}, {$this->codePostal} {$this->ville}";
    }
}

?>