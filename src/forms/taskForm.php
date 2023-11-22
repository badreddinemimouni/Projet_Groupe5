<?php
 
namespace Tp\Project\Forms;
 
// use Tp\Project\Forms;
 
class taskForm
{
    public static function form($action)
    {
        $form = "<form action=$action method='POST'>
        <label for='task_title'>Nom de la tâche</label>
        <input type='text' name='task_title' class='form' autocomplete='task_title' required autofocus>
        <label for='task_priority'>Priorité de la tâche</label>
        <input type='hidden' name='project_id' value='" . $_GET['project_id'] . "'>
        <select name='task_priority' class='form' autocomplete='task_priority' required autofocus>
            <option value='1'>Haute</option>
            <option value='2'>Moyenne</option>
            <option value='3'>Faible</option>
        </select>
        <label for='task_description'>Description de la tâche</label>
        <input type='text' name='task_description' class='form' autocomplete='task_description' required autofocus>
        <label for='user_assigned'>Affecter un utilisateur</label>
        <input type='text' name='user_assigned' class='form' autocomplete='user_assigned' required autofocus>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Créer ma tâche
        </button>
    </form>";
        return $form;
    }

    public static function validateFormTask()
    {
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

        if (count($error) > 0) {
            return $error;
        }
        return true;
    }
}