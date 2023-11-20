<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires

use Tp\Project\App\AbstractController;
use Tp\Project\Forms\registrationForm;
use Tp\Project\App\Model;

class UsersController extends AbstractController
{
    // Méthode pour afficher formulaire de création d'utilisateur

    public function registerUser(): void
    {
        $vars = [
            'form' => registrationForm::form('?controller=usersController&method=createUser'),
        ];
        $this->render('registration.php', $vars);
    }

    // Méthode pour créer d'utilisateur
    public function createUser(): void
    {
        $datas = [
            'password' => $_POST['password'],
            'login' => $_POST['username'],
        ];
        Model::getInstance()->save('users', $datas);
    }

    // Méthode pour connecter un utilisateur
    public function loginUser(): void
    {
        $results = Model::getInstance()->loginUser('user');
        $this->render('users.php', ['users' => $results]);
    }

    // Méthode pour récupérer les détails d'un utilisateur spécifique
    public function getUserDetails()
    {
        $results = Model::getInstance()->getUserDetails('user');
        $this->render('users.php', ['users' => $results]);
    }
}
