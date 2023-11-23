<?php

namespace Tp\Project\App;

// Classe abstraite qui sert de base pour les contrôleurs spécifiques
class AbstractController
{

    public function __construct()
    {
        // Vérifie si la session n'est pas déjà démarrée, puis démarre une session si elle n'est pas active
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    // Méthode pour rendre une vue avec des variables associées
    public function render($view, $vars)
    {
        include_once(__DIR__ . '/../Views/header.php'); // Inclut le fichier d'en-tête de la vue
        extract($vars); // Extrait les variables pour les rendre accessibles dans la vue
        include_once(__DIR__ . '/../Views/' . $view); // Inclut le fichier de vue spécifié
    }
}