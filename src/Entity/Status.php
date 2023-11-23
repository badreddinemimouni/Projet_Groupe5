<?php

namespace Tp\Project\Entity;

class Status
{
    private int $id_status;
    private ?string $value;

    // Méthode pour récupérer la valeur de statut
    public function getStatusValue()
    {
        return $this->value;
    }

    public function getId()
    {
        return $this->id_status;
    }
}
