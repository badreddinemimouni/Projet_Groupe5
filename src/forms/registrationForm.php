<?php

namespace Tp\Project\Forms;

use Tp\Project\Forms;

class registrationForm
{
    public static function form($action)
    {
        echo 'ssa';
        $form = "<form action=$action method='POST'>
        <label for='username'>Nom d'utilisateur</label>
        <input type='text' name='username' class='form' autocomplete='username' required autofocus>
        <label for='password'>Mot de passe</label>
        <input type='password' name='password' id='password'>
        <label for='confirm-password'>Confirmer le mot de passe</label>
        <input type='password' name='confirm-password' id='confirm-password'>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            S'enregistrer'
        </button>
    </form>";
        return $form;
    }

    public static function validateFormRegistration()
    {
        $error = [];
        if (isset($_POST['username']) && strlen($_POST['username']) < 5) {
            $error[] = 'Le nom d\'utilisateur doit comporter 5 caractères';
        }
        if (isset($_POST['username']) && strlen($_POST['username']) < 5) {
            $error[] = 'Le mot de passe doit comporter 5 caractères';
        }

        if (isset($_POST['password']) && isset($_POST['confirm-password']) && ($_POST['password'] !== $_POST['confirm-password'])) {
            $error[] = 'Les mots de passe doivent être identiques';
        }

        if (count($error) > 0) {
            return $error;
        }
        return true;
    }
}
