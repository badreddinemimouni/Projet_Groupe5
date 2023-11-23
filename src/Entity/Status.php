<?php

namespace Tp\Project\Entity;

class Status {
    private int $id_status;
    private ?string $value;

    // Méthode pour récupérer la valeur de statut
    public function getStatusValue() {
        return $this->value;
    }
}