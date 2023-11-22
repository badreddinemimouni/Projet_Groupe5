<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\Dispatcher;
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
        $projectName = $_POST['project'];
        $userId = $_SESSION['user_id'];
        $adminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);

        if (!$adminId) {
            $adminDatas = [
                'user_id' => $userId,
            ];
            $admin = Model::getInstance()->save('admin', $adminDatas);
        }
        $adminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
        $datas = [
            'name' => $_POST['project'],
            'id_admin' => $adminId
        ];
        $validationMessage = projectForm::validateFormProject(); // appele la méthode statique validateFormProject de la classe projectForm.
        if ($validationMessage === true) {
            Model::getInstance()->save('project', $datas);
            $projectId = Model::getInstance()->getAttributeByAttribute('project', 'id',  'name', $projectName);
            $participateDatas = [
                'id' => $projectId,
                'user_id' => $userId,
            ];
            Model::getInstance()->save('participate', $participateDatas);
        } else {
            echo $validationMessage . '<br><br>';
        }
        Dispatcher::redirect('projectController', 'displayProjectsByUserId');
    }

    public function displayProjectsByUserId()
    {
        $userId = $_SESSION['user_id'];
        $projects = Model::getInstance()->getProjectByParticipateUserId($userId);
        $this->render('projects.php', ['projects' => $projects]);
    }
}
