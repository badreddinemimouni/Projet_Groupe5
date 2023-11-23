<?php

namespace Tp\Project\App;

use Tp\Project\App\Model;


class Security
{
    // Vérifie si l'utilisateur existe dans la base de données en fonction du login
    public static function verifyUser($login)
    {
        $user = Model::getInstance()->getByAttribute('users', 'login', $login);
        if (!empty($user)) {
            return true; // L'utilisateur existe
        }
        return false; // L'utilisateur n'existe pas
    }

    // Récupère les données de l'utilisateur en fonction du nom d'utilisateur
    public static function getUserData($user)
    {
        $userData = Model::getInstance()->getByAttribute('users', 'login', $user);
        return $userData; // Retourne les données de l'utilisateur
    }

    // Vérifie si l'utilisateur est connecté en vérifiant la présence de la clé 'connected' dans la session
    public static function is_connected()
    {
        if (isset($_SESSION['connected'])) {
            return true; // L'utilisateur est connecté
        }
        return false; // L'utilisateur n'est pas connecté
    }
}
