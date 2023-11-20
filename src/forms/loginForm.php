<?php

function constructLoginForm()
{
    return "<form action='" . generateUrl('security', 'login') . "' method='POST'>
        <label for='username'>Nom d'utilisateur</label>
        <input type='text' name='username' class='form-control' autocomplete='username' required autofocus>
        <label for='password'>Mot de passe</label>
        <input type='password' name='password' id='password' class='form-control'>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Se connecter
        </button>
    </form>";
}

function processFormLogin()
{
    $error = false;
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        if (($password = getUser($username)) !== false) {
            if (password_verify($_POST['password'], $password)) {
                $_SESSION['connected'] = 'connecté';
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
