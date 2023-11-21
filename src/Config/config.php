<?php

namespace Tp\Project\Config;

use PDO;

class Config
{
    const DBNAME = "project";
    const DBHOST = 'localhost';
    const DBUSER = 'badr';
    const DBPWD = '';
    const ENTITY = 'Tp\Project\Entity\\';
    const CONTROLLER = 'Tp\Project\Controller\\';
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
