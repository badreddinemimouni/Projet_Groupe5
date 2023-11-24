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

    // Méthode pour créer un utilisateur
    public function createUser(): void
    {
        $validationMessages = registrationForm::validateFormRegistration();
        if ($validationMessages === true) {
            // Verification que l'user nexiste pas deja
            $isUserExist = Model::getInstance()->getByAttribute('users', 'login', $_POST['username']);
            if (!$isUserExist) {
                $datas = [
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'login' => $_POST['username'],
                ];
                Model::getInstance()->save('users', $datas);
                // Après avoir enregistré l'utilisateur avec succès, initialise la session 'connected'
                Dispatcher::redirect('usersController', 'connectUser');
            } else {
                echo "Utilisateur déjà existant";
            }
        } else {
            foreach ($validationMessages as $message) {
                echo $message . '<br><br>';
            }
        }
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
            Dispatcher::redirect('indexController', 'index');
        } else {
            echo $validConnexion;
        };
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
