<?php

namespace Tp\Project\Entity;

class Project
{
    private int $id;
    private ?string $name;
    private int $id_admin;

    public function getName()
    {
        return $this->name;
    }
}
