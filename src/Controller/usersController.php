<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\Forms\LoginForm;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\registrationForm;
use Tp\Project\App\Model;
use Tp\Project\App\Dispatcher;

class UsersController extends AbstractController
{
    // Méthode pour afficher formulaire de création d'utilisateur

    public function registerUser(): void
    {
        $vars = [
            'form' => registrationForm::form('?Controller=usersController&method=createUser'),
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
    }

    public function connectUser(): void
    {
        $vars = [
            'form' => LoginForm::constructLoginForm('?Controller=usersController&method=connect'),
        ];

        $this->render('login.php', $vars);
    }

    public function connect(): void
    {

        $datas = [
            'password' => $_POST['password'],

            'login' => $_POST['username'],

        ];
        $ValidConnexion = loginForm::processFormLogin();

        if ($ValidConnexion === true) {
            Model::getInstance()->save('users', $datas);
            echo 'letsgoo';
        } else {
            foreach ($ValidConnexion as $message) {
                echo $message . '<br><br>';
            }
        }
        Dispatcher::redirect('indexController', 'index');
    }

}


   