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

    // Méthode pour récupérer l'id admin du projet
    public function getIdAdmin()
    {
        return $this->id_admin;
    }
}
