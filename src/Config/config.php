<?php

namespace Tp\Projet\Config;

use PDO;

class Config
{
    const DBNAME = "project";
    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const DBPWD = 'root';
    const ENTITY = 'Keha\Test\Entity\\';
    const CONTROLLER = 'Keha\Test\Controller\\';
    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_METHOD = 'index';
}

new Config();
try {

    $dbh = new PDO(
        "mysql:dbname=" . Config::DBNAME . ";host=" . Config::DBHOST,
        Config::DBUSER,
        Config::DBPWD
    );
    echo 'salut';
} catch (\PDOException $e) {
    echo $e->getMessage();
    echo 'marche pas';
}
