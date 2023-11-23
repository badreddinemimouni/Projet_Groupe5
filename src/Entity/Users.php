<?php

namespace Tp\Project\Entity;

class Users
{
    private int $user_id;
    private string $password;
    private string $login;

    // Méthode pour récupérer le nom d'utilisateur
    public function getLogin()
    {
        return $this->login;
    }

    // Méthode pour récupérer le mot de passe de l'utilisateur
    public function getPassword()
    {
        return $this->password;
    }

    // Méthode pour récupérer l'identifiant de l'utilisateur
    public function getuserId()
    {
        return $this->user_id;
    }
}
