<?php
 
namespace Tp\Project\Forms;
 
use Tp\Project\Forms;
 
class loginForm 
{
    
    public static function constructLoginForm($action)
    {
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

    function processFormLogin()
    {
        $error = false;
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            if (($password = getPasswordByLogin($username)) !== false) {
                if ($_POST['password'] === $password) {
                    $_SESSION['connected'] = 'connecté';
                    echo 'cestbobn';
                    return true;
                    
                } else {
                    $error = 'Identifiants non reconnus';
                }
            } else {
                $error = 'Identifiants non reconnus';
            }
        }
        return $error;
    }

   
}
 
 

 