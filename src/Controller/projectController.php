<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\projectForm;

class ProjectController extends AbstractController
{

    // Méthode pour créer un nouveau projet avec un administrateur
    public function registerFormProject(): void
    {
        $vars = [
            'form' => projectForm::form('?controller=projectController&method=createProject'),
        ];
        $this->render('project.php', $vars);
    }

    public function createProject()
    {
        $datas = [
            'name' => $_POST['project'],
            'id_admin' => 1,
        ];
        $validationMessage = projectForm::validateFormProject(); // appele la méthode statique validateFormProject de la classe projectForm.
        if ($validationMessage === true) {
            Model::getInstance()->save('project', $datas);
        } else {
            echo $validationMessage . '<br><br>';
        }
    }
}