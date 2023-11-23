<?php
include_once('vendor/autoload.php');

use Tp\Project\App\Dispatcher;
use Tp\Project\App\Security;

Dispatcher::Dispatch(); // Appel à la méthode statique Dispatch() de la classe Dispatcher pour diriger la requête HTTP vers le bon contrôleur 
Security::is_connected(); // Vérification de la connexion de l'utilisateur avec la méthode statique is_connected() de la classe Security
