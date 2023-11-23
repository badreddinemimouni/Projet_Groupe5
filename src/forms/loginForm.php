<?php

namespace Tp\Project\Forms;

use Tp\Project\App\Model;
use Tp\Project\Controller\UsersController;
use Tp\Project\App\Security;
use Tp\Project\Entity\Users;

class loginForm
{

    public static function constructLoginForm($action)
    {
        // Formulaire de connexion
        $form = "<form action= $action method='POST'>
            <label for='username'>Nom d'utilisateur</label>
            <input type='text' name='username' class='form-control' autocomplete='username' required autofocus>
            <label for='password'>Mot de passe</label>
            <input type='password' name='password' id='password' class='form-control'>
            <button class='btn btn-lg btn-primary' type='submit' name='submit'>
                Se connecter
            </button>
        </form>";

        return $form;
    }

    public static function processFormLogin()
    {
        // Traitement du formulaire de connexion
        $error = 'Identifiants non reconnus';

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $verify = Security::verifyUser($username);

            if ($verify !== false) {
                $userData = Security::getUserData($username);
                $password = $userData[0]->getPassword();
                $user_id = $userData[0]->getUserId();

                if (password_verify($_POST['password'], $password)) {
                    // Authentification réussie, configuration de la session
                    $_SESSION['connected'] = 'connected';
                    $_SESSION['user_id'] = $user_id;
                    return true;
                }
            }
        }
        return $error; // Retourne une erreur si l'authentification échoue
    }
}
