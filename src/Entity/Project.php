<?php

namespace Tp\Project\Entity;

class Project
{
    private int $id;
    private ?string $name;
    private int $id_admin;

    // Méthode pour récupérer le nom du projet
    public function getName()
    {
        return $this->name;
    }

    // Méthode pour récupérer l'identifiant du projet
    public function getId()
    {
        return $this->id;
    }
<<<<<<<<< Temporary merge branch 1
    public function getIdAdmin()
    {
        return $this->id_admin;
    }
}
=========
}
>>>>>>>>> Temporary merge branch 2
