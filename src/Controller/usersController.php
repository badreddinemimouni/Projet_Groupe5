<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires

use Tp\Project\App\AbstractController;
use Tp\Project\Forms\registrationForm;
use Tp\Project\Forms\loginForm;
use Tp\Project\App\Model;
use Tp\Project\App\Dispatcher;

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
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'login' => $_POST['username'],
        ];
        $validationMessages = registrationForm::validateFormRegistration();
        if ($validationMessages === true) {
            Model::getInstance()->save('users', $datas);
        } else {
            foreach ($validationMessages as $message) {
                echo $message . '<br><br>';
            }
        }
        Dispatcher::redirect('indexController', 'index');
    }

    // Méthode pour afficher le formulaire de connexion d'utilisateur
    public function connectUser(): void
    {
        $vars = [
            'form' => loginForm::constructLoginForm('?controller=usersController&method=connect'),
        ];

        $this->render('login.php', $vars);
    }

    // Méthode pour gérer la connexion de l'utilisateur
    public function connect(): void
    {
        $validConnexion = loginForm::processFormLogin();
        if ($validConnexion === true) {
            echo "connecté";
        } else {
            echo $validConnexion;
        };
        Dispatcher::redirect('indexController', 'index');
    }

    // Méthode pour déconnecter l'utilisateur
    public static function disconnect()
    {
        if ($_SESSION['connected']) {
            unset($_SESSION['connected']);
        }
        Dispatcher::redirect('indexController', 'index');
    }
}
