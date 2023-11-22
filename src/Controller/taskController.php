<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\TaskForm;
use Tp\Project\App\Dispatcher;

class TaskController extends AbstractController
{

    // Méthode pour créer et ajouter une nouvelle tâche à un projet

    public function registerFormTask(): void
    {
        $vars = [
            'form' => taskForm::form('?controller=taskController&method=createTask'),
        ];
        $this->render('task.php', $vars);
    }

    public function createTask()
    {
        $project_id = $_POST['project_id'];
        $datas = [
            // Récupérer les valeurs des champs distincts du formulaire
            'title' => $_POST['task_title'],
            'description' => $_POST['task_description'],
            'id_priority' => $_POST['task_priority'],
            'id_status' => 1,
            'user_id' => $_POST['user_assigned'],
            'project_id' => $_POST['project_id'],
        ];
        $validationMessages = taskForm::validateFormTask();
        if ($validationMessages === true) {
            Model::getInstance()->save('task', $datas);
            Dispatcher::redirect('taskController', 'displayTasksByProject', ['id' => $project_id]);
        } else {
            foreach ($validationMessages as $message) {
                echo $message . '<br><br>';
            }
        }
    }

    // Méthode pour mettre à jour l'état d'une tâche
    /* public function updateTaskStatus()
    {
        $datas = [
            'status' => $_GET['status'],
        ];
        $id_task = $_GET['id'];
        Model::getInstance()->updateById('task', $id_task, $datas);
    } */

    public function updateTaskStatus()
    {
    if (isset($_POST['task_id'], $_POST['status'])) {
        $id_task = $_POST['task_id'];
        $new_status = $_POST['status'];
        $datas = ['id_status' => $new_status];
        Model::getInstance()->updateById('task', $id_task, $datas);
    }
    // Redirige vers la page précédente après la mise à jour
    //$this->redirect('taskController', 'displayTasksByProject');
    }

    // Méthode pour supprimer une tâche
    public function deleteTask()
    {
        $id_task = $_GET['id'];
        Model::getInstance()->deleteById('livre', $id_task);
    }

    // Méthode pour récupérer toutes les tâches associées à un projet
    public function displayTasksByProject()
    {
        $projectId = $_GET['id'];
        $tasks = Model::getInstance()->getByAttribute('task', 'project_id', $projectId);
        $this->render('tasks.php', ['tasks' => $tasks]);
    }
}
