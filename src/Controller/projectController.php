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
        $userId = $_SESSION['user_id'];
        $admin = Model::getInstance()->getByAttribute($admin, 'user_id', $userId);
        if (!empty($admin_id)) {
            $adminId = $admin[0]->getId();
        } else {
        }

        $datas = [
            'name' => $_POST['project'],
            'id_admin' => $adminId
        ];
        $validationMessage = projectForm::validateFormProject(); // appele la méthode statique validateFormProject de la classe projectForm.
        if ($validationMessage === true) {
            Model::getInstance()->save('project', $datas);
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
