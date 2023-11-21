<?php

namespace Tp\Project\Controller;
 
// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\Entity\Users;

class UsersController {
    // Méthode pour inscrire un nouvel utilisateur
    public function registerUser(): void
    {
        $datas = [
            'nom' => $_GET['nom'],
            'email' => $_GET['email'],
            'password' => $_GET['password'],
        ];
        Model::getInstance()->save('users', $datas);
    }

    // Méthode pour connecter un utilisateur
    public function loginUser(): void
    {
        $results = Model::getInstance()->loginaUser('user');
        $this->render('users.php', ['users' => $results]);
    }
    
    // Méthode pour récupérer les détails d'un utilisateur spécifique
    public function getUserDetails()
    {
        $results = Model::getInstance()->getaUserDetails('user');
        $this->render('users.php', ['users' => $results]);
    }
}