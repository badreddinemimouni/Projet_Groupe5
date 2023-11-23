<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\Dispatcher;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\projectForm;

class ProjectController extends AbstractController
{

    // Méthode pour afficher le formulaire de création d'un nouveau projet
    public function registerFormProject(): void
    {
        $vars = [
            'form' => projectForm::form('?controller=projectController&method=createProject'),
        ];
        $this->render('project.php', $vars);
    }

    // Méthode pour créer un nouveau projet
    public function createProject()
    {
        // Récupération du nom du projet et de l'identifiant de l'utilisateur connecté
        $projectName = $_POST['project'];
        $userId = $_SESSION['user_id'];

        // Vérification de l'existence de l'administrateur dans la table 'admin'
        $adminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
        if (!$adminId) {
            // Si l'administrateur n'existe pas, il est créé
            $adminDatas = [
                'user_id' => $userId,
            ];
            $admin = Model::getInstance()->save('admin', $adminDatas);
        }

        // Récupération de l'ID de l'administrateur
        $admin = Model::getInstance()->getByAttribute('admin', 'user_id', $userId);
        $adminId = $admin[0]->getId();

        // Préparation des données pour créer le projet
        $datas = [
            'name' => $_POST['project'],
            'id_admin' => $adminId
        ];

        // Validation du formulaire de création de projet
        $validationMessage = projectForm::validateFormProject();
        if ($validationMessage === true) {
            // Sauvegarde du projet dans la base de données
            Model::getInstance()->save('project', $datas);

            // Récupération de l'ID du projet nouvellement créé
            $projectId = Model::getInstance()->getByAttribute('project', 'name', $projectName);

            // Ajout de l'utilisateur comme participant au projet
            $participateDatas = [
                'id' => $projectId,
                'user_id' => $userId,
            ];
            Model::getInstance()->save('participate', $participateDatas);

            // Redirection vers l'affichage des projets de l'utilisateur connecté
            Dispatcher::redirect('projectController', 'displayProjectsByUserId');
        } else {
            echo $validationMessage . '<br><br>';
        }
        Dispatcher::redirect('projectController', 'displayProjectsByUserId');
    }

    // Méthode pour afficher tous les projets associés à un utilisateur
    public function displayProjectsByUserId()
    {
        $userId = $_SESSION['user_id'];
        $projects = Model::getInstance()->getProjectByParticipateUserId($userId);
        $this->render('projects.php', ['projects' => $projects]);
    }
}
