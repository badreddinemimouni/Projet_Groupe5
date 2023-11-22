<?php

namespace Tp\Project\App;

class AbstractController
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function render($view, $vars)
    {
        include_once(__DIR__ . '/../Views/header.php');
        extract($vars);
        include_once(__DIR__ . '/../Views/' . $view);
    }
}
