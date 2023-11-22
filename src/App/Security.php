<?php

namespace Tp\Project\App;

use Tp\Project\App\Model;
use Tp\Project\App\Dispatcher;

class Security
{
    public static function verifyUser($login)
    {
        $user = Model::getInstance()->getByAttribute('users', 'login', $login);
        if (!empty($user)) {
            return true;
        }
        return false;
    }

    public static function getUserData($user)
    {
        $userData = Model::getInstance()->getByAttribute('users', 'login', $user);
        return $userData;
    }

    public static function disconnect()
    {
        if ($_SESSION['connected']) {
            unset($_SESSION['connected']);
        }
    }

    public static function is_connected()
    {
        if (isset($_SESSION['connected'])) {
            return true;
        }
        return false;
    }
}
