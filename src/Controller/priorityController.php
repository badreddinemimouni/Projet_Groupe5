<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\Entity\Priority;

class PriorityController {
    private $level;

    public function __construct($level) {
        $this->level = $level;
    }

    public function getLevel() {
        return $this->level;
    }
    
    // Vous pouvez ajouter d'autres fonctionnalités spécifiques liées à la priorité ici
}
