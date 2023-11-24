<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\TaskForm;
use Tp\Project\Forms\updateTaskForm;
use Tp\Project\App\Dispatcher;

class TaskController extends AbstractController
{

    // Méthode pour afficher le formulaire de création d'une nouvelle tâche
    public function registerFormTask(): void
    {
        $vars = [
            'form' => taskForm::form('?controller=taskController&method=createTask'),
        ];
        $this->render('task.php', $vars);
    }

    // Méthode pour créer une nouvelle tâche
    public function createTask()
    {
        $userId = $_SESSION['user_id'];
        $userAdminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
        $project_id = $_POST['project_id'];
        $projectAdminId = Model::getInstance()->getAttributeByAttribute('project', 'id_admin', 'id', $project_id);
        // Verification que l'user est admin du projet
        if ($userAdminId === $projectAdminId) {
            $validationMessages = taskForm::validateFormTask();
            if ($validationMessages === true) {
                $datas = [
                    // Récupére les valeurs des champs distincts du formulaire
                    'title' => $_POST['task_title'],
                    'description' => $_POST['task_description'],
                    'id_priority' => $_POST['task_priority'],
                    'id_status' => 1, // Tache créé automatiquement définis sur status 1
                    'user_id' => $_POST['user_assigned'],
                    'project_id' => $_POST['project_id'],
                ];
                Model::getInstance()->save('task', $datas);
                Dispatcher::redirect('taskController', 'displayTasksByProject', ['id' => $project_id]);
            } else {
                foreach ($validationMessages as $message) {
                    echo $message . '<br><br>';
                }
            }
        } else {
            echo "non autorisé à créer une tâche";
        }
    }

    // Méthode pour afficher le formulaire d'actualisation d'une nouvelle tâche
    public function UpdateFormTask(): void
    {
        $vars = [
            'form' => updateTaskForm::form('?controller=taskController&method=updateTask'),
        ];
        $this->render('updatetask.php', $vars);
    }

    // Méthode pour mettre à jour le statut d'une tâche
    public function updateTask()
    {
        $userId = $_SESSION['user_id'];
        $userAdminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
        $id_task = $_POST['id_task'];
        $task = Model::getInstance()->getOneByAttribute('task', 'id_task', $id_task);
        $projectId = $task->getProjectId();
        $project = Model::getInstance()->getOneByAttribute('project', 'id', $projectId);
        $projectAdmin = $project->getIdAdmin();

        // Verification que l'utilisateur de la session est admin du projet
        if ($projectAdmin === $userAdminId) {
            $validationMessages = updateTaskForm::validateUpdateFormTask();
            // verificaiton que le formulaire est rempli correctement
            if ($validationMessages === true) {
                $datas = [
                    // Récupére les valeurs des champs distincts du formulaire
                    'title' => $_POST['task_title'],
                    'id_priority' => $_POST['task_priority'],
                    'description' => $_POST['task_description'],
                    'user_id' => $_POST['user_assigned'],
                    'id_status' => $_POST['task_status'],
                ];
                // update de la tache
                Model::getInstance()->updateByAttribute('task', 'id_task', $id_task, $datas);
                // redirection vers les taches du projet
                Dispatcher::redirect('taskController', 'displayTasksByProject', ['id' => $task->getProjectId()]);
            } else {
                foreach ($validationMessages as $message) {
                    echo $message . '<br><br>';
                }
            }
        } else {
            echo "vous n'avez pas les droits";
        }
    }

    // Méthode pour supprimer une tâche
    public function deleteTask()
    {
        $userId = $_SESSION['user_id'];
        $userAdminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
        $id_task = $_GET['id_task'];
        $task = Model::getInstance()->getOneByAttribute('task', 'id_task', $id_task);
        $projectId = $task->getProjectId();
        $project = Model::getInstance()->getOneByAttribute('project', 'id', $projectId);
        $projectAdminId = $project->getIdAdmin();
        $isAdmin = $userAdminId === $projectAdminId;
        if ($isAdmin) {
            // Suppression
            Model::getInstance()->deleteByAttribute('task', 'id_task', $id_task);
            // redirection vers les taches du projet
            Dispatcher::redirect('taskController', 'displayTasksByProject', ['id' => $projectId]);
        } else {
            echo "Suppression impossible";
        }
    }

    // Méthode pour afficher toutes les tâches associées à un projet
    public function displayTasksByProject()
    {
        $projectId = $_GET['id'];
        $tasks = Model::getInstance()->getByAttribute('task', 'project_id', $projectId);
        $this->render('tasks.php', ['tasks' => $tasks]);
    }
}
