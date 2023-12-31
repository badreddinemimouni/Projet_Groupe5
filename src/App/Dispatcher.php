<?php

namespace Tp\Project\App;

use Tp\Project\Config\Config;


// Classe Dispatcher responsable du routage des requêtes dans l'application
class Dispatcher
{
    public static function Dispatch()
    {
        $c = false; 
        $m = false;
        if (isset($_GET['controller']) && isset($_GET['method'])) {
            if (class_exists(Config::CONTROLLER . $_GET['controller'])) {
                $c = Config::CONTROLLER . $_GET['controller'];
                $controller = new $c();
                if (method_exists($controller, $_GET['method'])) {
                    $m = $_GET['method'];
                    $controller->$m();
                    return;
                }
            }
        }
        $c = Config::CONTROLLER . Config::DEFAULT_CONTROLLER;
        $m = Config::DEFAULT_METHOD;
        $controller = new $c();
        $controller->$m();
    }

    // Méthode pour générer une URL basée sur le contrôleur et la méthode spécifiés, avec des paramètres supplémentaires facultatifs
    public static function generateUrl($controller, $method, $query = null)
    {
        $url = 'index.php?controller=' . $controller . '&method=' . $method;
        if (is_array($query) && count($query) > 0) {
            foreach ($query as $key => $value) {
                $url = $url . '&' . $key . '=' . $value;
            }
        }
        return $url;
    }

    // Méthode pour rediriger vers une autre URL en utilisant l'URL générée à partir du contrôleur, de la méthode et des paramètres spécifiés
    public static function redirect($controllerName, $method, $query = null)
    {
        header('location: ' . self::generateUrl($controllerName, $method, $query));
    }
}
