<?php

namespace Tp\Project\Forms;

use Tp\Project\App\Model;


class registrationForm
{
    public static function form($action)
    {
        // Formulaire de création d'utilisateur
        $form = "<form action=$action method='POST'>
        <label for='username'>Nom d'utilisateur</label>
        <input type='text' name='username' class='form' autocomplete='username' required autofocus>
        <label for='password'>Mot de passe</label>
        <input type='password' name='password' id='password'>
        <label for='confirm-password'>Confirmer le mot de passe</label>
        <input type='password' name='confirm-password' id='confirm-password'>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            S'enregistrer
        </button>
    </form>";
        return $form;
    }

    public static function validateFormRegistration()
    {

        // Validation des données du formulaire
        $error = [];
        if (isset($_POST['username'])) {
            // Verification que l'user nexiste pas deja
            $isUserExist = Model::getInstance()->getByAttribute('users', 'login', $_POST['username']);
            if ($isUserExist) {
                $error[] = 'Utilisateur déja existant';
            }
        }
        if (!isset($_POST['username']) || strlen($_POST['username']) < 5) {
            $error[] = 'Le nom d\'utilisateur doit comporter 5 caractères';
        }
        // vérifie la présence des deux champs, et vérifie si les deux champs sont vides.
        if ((!isset($_POST['password']) || empty($_POST['password'])) || (!isset($_POST['confirm-password']) || empty($_POST['confirm-password']))) {
            $error[] = 'Veuillez entrer un mot de passe et le confirmer';
        } elseif (strlen($_POST['password']) < 5) {
            $error[] = 'Le mot de passe doit comporter au moins 5 caractères';
        } elseif ($_POST['password'] !== $_POST['confirm-password']) {
            $error[] = 'Les mots de passe doivent être identiques';
        }

        // Vérification des erreurs
        if (count($error) > 0) {
            return $error; // Retourne les erreurs si elles existent
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}
