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









   /*  public function displayProjects(): void
    {
        $vars = [
            'form' => projectForm::form('?controller=projectController&method=createProject'),
        ];
        $this->render('project.php', $vars);
    } */

//     // Méthode pour mettre à jour les détails d'un projet
//     public function updateProject()
//     {
        
//     }

//     // Méthode pour supprimer un projet et ses données associées
//     public function deleteProject()
//     {
//         // Supprimer les tâches associées au projet (cette logique peut varier en fonction de vos besoins)
      

//         // Supprimer le projet lui-même
        
//     }

//     // Méthode pour gérer les utilisateurs associés à un projet (ajout ou suppression d'utilisateur)
//     public function manageProjectUsers()
//     {
//         // Ajouter un utilisateur au projet
     
//             // Supprimer un utilisateur du projet
       
//         // Autres opérations après la gestion des utilisateurs, si nécessaire
//     }
// 