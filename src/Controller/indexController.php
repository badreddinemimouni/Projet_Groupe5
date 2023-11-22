<?php

namespace Tp\Project\Controller;

use Tp\Project\App\AbstractController;

class IndexController extends AbstractController
{
    public function index($message = ''): void
    {
        $this->render('index.php', ['message' => $message]);
    }
}
