<?php

namespace Tp\Project\Config;

use PDO;

class Config
{
    const DBNAME = "project";
    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const DBPWD = 'root';
    const ENTITY = 'Tp\Project\Entity\\';
    const CONTROLLER = 'Tp\Project\Controller\\';
    const DEFAULT_CONTROLLER = 'indexController';
    const DEFAULT_METHOD = 'index';
}

// new Config();
