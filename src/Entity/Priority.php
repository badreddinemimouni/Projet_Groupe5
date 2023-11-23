<?php

namespace Tp\Project\Entity;

class Priority
{
    private int $id_priority;
    private ?string $value;

    // Méthode pour récupérer la valeur de priorité
    public function getPriorityValue() {
        return $this->value;
    }
}