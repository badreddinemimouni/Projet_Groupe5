<?php

namespace Tp\Project\Entity;

class Participate
{
    private int $id;
    private int $user_id;

    public function getUserId()
    {
        return $this->user_id;
    }
}
