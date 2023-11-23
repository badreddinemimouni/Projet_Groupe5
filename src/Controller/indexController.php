<?php

namespace Tp\Project\Controller;

use Tp\Project\App\AbstractController;

class IndexController extends AbstractController
{
    // Méthode pour afficher la page d'accueil
    public function index($message = ''): void
    {
        // Affiche la vue "index.php" en passant un éventuel message en paramètre
        $this->render('index.php', ['message' => $message]);
    }
}