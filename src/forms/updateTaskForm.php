<?php

namespace Tp\Project\Forms;

use Tp\Project\App\Model;

class updateTaskForm
{
    public static function form($action)
    {
        $task_id = $_GET['id_task'];
        $tasks = Model::getInstance()->getByAttribute('task', 'id_task' ,$task_id);
        $task = $tasks[0]; // prend le 1er objet du tableau
        $task_priority = $task->getPriority();
        // Formulaire d'actualisation de tâche
        $form = "<form action=$action method='POST'>
        <label for='task_title'>Nom de la tâche</label>
        <input type='text' name='task_title' value='" . $task->getTitle() . "'>
        <input type='hidden' name='id_task' value='".$task_id."'>
        <label for='task_priority'>Priorité de la tâche</label>
        <select name='task_priority' class='form' autocomplete='task_priority' required autofocus>
        <option value='1' " . ($task_priority === 1 ? 'selected' : '') . ">Haute</option>
        <option value='2' " . ($task_priority === 2 ? 'selected' : '') . ">Moyenne</option>
        <option value='3' " . ($task_priority === 3 ? 'selected' : '') . ">Faible</option>
        </select>
        <label for='task_description'>Description de la tâche</label>
        <input type='text' name='task_description' value='" . $task->getDescription() . "' class='form' autocomplete='task_description' required autofocus>
        <label for='task_status'>Statut de la tâche</label>
        <input type='text' name='task_status' value='" . $task->getStatus() . "' class='form' autocomplete='task_status' required autofocus>
        <label for='user_assigned'>Affecter un utilisateur</label>
        <input type='text' name='user_assigned' class='form' autocomplete='user_assigned' required autofocus>
        <button class='btn btn-lg btn-primary' type='submit' name='submit' value='" . $task->getUserId() . "'>
            Actualiser ma tâche
        </button>
    </form>";
        return $form;
    }

    public static function validateUpdateFormTask()
    {
        // Validation des données du formulaire
        $error = [];
        if (isset($_POST['task_title']) && strlen($_POST['task_title']) < 3) {
            $error[] = 'Le titre de la tâche doit comporter au moins 3 caractères';
        }
        /* if (isset($_POST['task_priority']) && $_POST['task_priority'] < 3 && $_POST['task_priority'] >= 1) {
            $error[] = 'La priorité de la tâche doit être égale à Haute, Moyenne ou Faible.';
        } */
        if (isset($_POST['task_description']) && strlen($_POST['task_description']) < 5) {
            $error[] = 'La description de la tâche doit comporter au moins 3 caractères';
        }

        // Vérification des erreurs
        if (count($error) > 0) {
            return $error; // Retourne les erreurs si elles existent
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}