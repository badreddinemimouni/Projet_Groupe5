<?php

namespace Tp\Project\Entity;

class Admin
{
    private int $id_admin;
    private ?int $user_id;

    // Méthode pour récupérer l'identifiant de l'administrateur
    public function getId()
    {
        return $this->id_admin;
    }
}