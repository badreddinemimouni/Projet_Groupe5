<?php

namespace Tp\Project\Entity;

class Admin
{
    private int $id_admin;
    private ?int $user_id;
    public function getId()
    {
        return $this->id_admin;
    }
}
