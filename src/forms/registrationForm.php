<?php

namespace Tp\Project\Form;

use Tp\Project\App\Model;

class loginForm
{
    public static function form($action)
    {
        $form =  "<form action= $action method='POST'>
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
}


function validateFormRegistration()
{
    $error = [];
    if (isset($_POST['username']) && strlen($_POST['username']) < 5) {
        $error[] = 'Le nom d\'utilisateur doit comporter 5 caractères';
    }
    if (isset($_POST['password']) && strlen($_POST['password']) < 5) {
        $error[] = 'Le mot de passe doit comporter 5 caractères';
    }

    if (isset($_POST['password']) && isset($_POST['passwordverify']) && ($_POST['password'] !== $_POST['passwordverify'])) {
        $error[] = 'Lse mots de passe doivent être identiques';
    }

    if (count($error) > 0) {
        return $error;
    }
    return true;
}
