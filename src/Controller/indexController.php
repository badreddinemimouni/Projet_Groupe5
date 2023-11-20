<?php

namespace Tp\Project\Controller;

use Tp\Project\App\AbstractController;
use Tp\Project\App\Model;

class IndexController extends AbstractController
{
    public function index($message = ''): void
    {
        echo 'toto';
        $this->render('index.php', ['message' => $message]);
    }
}
