<?php

namespace Tp\Project\Entity;

class Users
{
    private int $user_id;
    private string $password;
    private string $login;

    public function getLogin()
    {
        return $this->login;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getuserId()
    {
        return $this->user_id;
    }
}
