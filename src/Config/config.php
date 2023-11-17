<?php
 
namespace Tp\Projet\Config;

use PDO;

class Config
{
    const DBNAME = "Project";
    const DBHOST = 'localhost';
    const DBUSER = 'badr';
    const DBPWD = '';
    const ENTITY = 'Tp\Projet\Entity\\';
    const CONTROLLER = 'Tp\Projet\Controller\\';
    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_METHOD = 'index'; 
}

new Config();
try {

    $dbh = new PDO("mysql:dbname=" . Config::DBNAME . ";host=" . Config::DBHOST,
    Config::DBUSER,
    Config::DBPWD);
    echo 'salut';
        
    
} catch (\PDOException $e) {
    echo $e->getMessage();
    echo 'marche pas';
}