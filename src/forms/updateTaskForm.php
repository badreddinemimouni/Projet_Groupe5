<?php

namespace Tp\Project\Forms;

use Tp\Project\App\Model;

class updateTaskForm
{
    public static function form($action)
    {
        $task_id = $_GET['id_task'];
        $tasks = Model::getInstance()->getByAttribute('task', 'id_task', $task_id);
        $task = $tasks[0]; // prend le 1er objet du tableau
        $projectId = $task->getProjectId();
        $projectUsers = Model::getInstance()->getParticipantsByproject($projectId);
        $task_priority = $task->getPriority();
        $taskStatus = $task->getStatus();
        $status = Model::getInstance()->getAll('status');
        $priorities = Model::getInstance()->getAll('priority');
        $userId = $task->getUserId();
        // Formulaire d'actualisation de tâche
        $form = "<form action=$action method='POST'>
        <label for='task_title'>Nom de la tâche</label>
        <input type='text' name='task_title' value='" . $task->getTitle() . "'>
        <input type='hidden' name='project_id' value='" . $projectId . "'>
        <input type='hidden' name='id_task' value='" . $task_id . "'>
        <label for='task_priority'>Priorité de la tâche</label>
        <select name='task_priority' class='form' autocomplete='task_status' required autofocus>";
        foreach ($priorities as $priority) {
            $form .= "<option value=" . $priority->getId() . ($priority->getId() === $task_priority ? ' selected' : '') . ">" . $priority->getPriorityValue() . "</option>";
        }

        $form .= "</select>
        <label for='task_description'>Description de la tâche</label>
        <input type='text' name='task_description' value='" . $task->getDescription() . "' class='form' autocomplete='task_description' required autofocus>
        <label for='task_status'>Status</label>
        <select name='task_status' class='form' autocomplete='task_status' required autofocus>";
        foreach ($status as $state) {
            $form .= "<option value=" . $state->getId() . ($state->getId() === $taskStatus ? ' selected' : '') . ">" . $state->getStatusValue() . "</option>";
        }

        $form .= "</select>
        <label for='user_assigned'>Affecter un utilisateur</label>
        <select name='user_assigned' class='form' autocomplete='user_assigned' required autofocus>";
        foreach ($projectUsers as $projectUser) {
            $form .= "<option value=" . $projectUser->getUserId() . ($projectUser->getUserId() === $userId ? ' selected' : '') . ">" . $projectUser->getLogin() . "</option>";
        }

        $form .= "</select>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
                Modifier ma tâche
            </button>
        </form>";
        return $form;
    }

    public static function validateUpdateFormTask()
    {
        // Validation des données du formulaire
        $error = [];
        if (!isset($_POST['task_title']) || strlen($_POST['task_title']) < 3) {
            $error[] = 'Le titre de la tâche doit comporter au moins 3 caractères';
        }
        if (!isset($_POST['task_priority'])) {
            $error[] = 'La priorité de la tâche doit être égale à Haute, Moyenne ou Faible.';
        }
        if (!isset($_POST['task_description'])) {
            $error[] = 'La description de la tâche doit comporter au moins 3 caractères';
        }

        // Vérification des erreurs
        if (count($error) > 0) {
            return $error; // Retourne les erreurs si elles existent
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}
