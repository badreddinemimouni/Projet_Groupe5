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
        $admin = Model::getInstance()->getByAttribute('admin', 'user_id', $userId);
        if (empty($admin)) {
            echo "JSUIS LA";
            $adminDatas = [
                'user_id' => $userId,
            ];
            $admin = Model::getInstance()->save('admin', $adminDatas);
        }
        $admin = Model::getInstance()->getByAttribute('admin', 'user_id', $userId);
        $adminId = $admin[0]->getId();
        $datas = [
            'name' => $_POST['project'],
            'id_admin' => $adminId
        ];
        $validationMessage = projectForm::validateFormProject(); // appele la méthode statique validateFormProject de la classe projectForm.
        if ($validationMessage === true) {
            Model::getInstance()->save('project', $datas);
            $projectId = Model::getInstance()->getByAttribute('project', 'name', $projectName);
            $participateDatas = [
                'id' => $projectId[0]->getId(),
                'user_id' => $userId,
            ];
            Model::getInstance()->save('participate', $participateDatas);
            Dispatcher::redirect('projectController', 'displayProjectsByUserId');
        } else {
            echo $validationMessage . '<br><br>';
        }
    }

    public function displayProjectsByUserId()
    {
        $userId = $_SESSION['user_id'];
        $projects = Model::getInstance()->getProjectByParticipateUserId($userId);
        $this->render('projects.php', ['projects' => $projects]);
    }
}
