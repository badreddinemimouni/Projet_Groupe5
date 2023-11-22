<?php
include_once('vendor/autoload.php');

use Tp\Project\App\Dispatcher;
use Tp\Project\App\Security;

Dispatcher::Dispatch();
Security::is_connected();
