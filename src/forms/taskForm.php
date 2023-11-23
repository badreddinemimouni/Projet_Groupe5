<?php

namespace Tp\Project\Forms;

use Tp\Project\App\Model;


class taskForm
{
    public static function form($action)
    {
        // return $form;
        $projectId = $_GET['project_id'];
        $projectUsers = Model::getInstance()->getParticipantsByproject($projectId);
        $status = Model::getInstance()->getAll('status');
        $priorities = Model::getInstance()->getAll('priority');

        // Formulaire d'actualisation de tâche

        $form = "<form action=$action method='POST'>
        <label for='task_title'>Nom de la tâche</label>
        <input type='text' name='task_title' class='form' autocomplete='task_title' required autofocus>
        <input type='hidden' name='project_id' value='" . $projectId . "'>
        <label for='task_priority'>Priorité de la tâche</label>
        <select name='task_priority' class='form' autocomplete='task_status' required autofocus>";
        // Affichage de chaque propriété possible
        foreach ($priorities as $priority) {
            $form .= "<option value=" . $priority->getId() . ">" . $priority->getPriorityValue() . "</option>";
        }

        $form .= "</select>
        <label for='task_description'>Description de la tâche</label>
        <input type='text' name='task_description' class='form' autocomplete='task_description' required autofocus>
        <label for='task_status'>Status</label>
        <select name='task_status' class='form' autocomplete='task_status' required autofocus>";
        // Affichage de chaque statut possible 
        foreach ($status as $state) {
            $form .= "<option value=" . $state->getId() . ">" . $state->getStatusValue() . "</option>";
        }

        $form .= "</select>
        <label for='user_assigned'>Affecter un utilisateur</label>
        <select name='user_assigned' class='form' autocomplete='user_assigned' required autofocus>";
        // Affichage de chaque users qui participent au projet 
        foreach ($projectUsers as $projectUser) {
            $form .= "<option value=" . $projectUser->getUserId() . ">" . $projectUser->getLogin() . "</option>";
        }

        $form .= "</select>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
                Ajouter la tâche
            </button>
        </form>";
        return $form;
    }

    public static function validateFormTask()
    {
        // Validation des données du formulaire
        $error = [];
        if (!isset($_POST['task_title']) || strlen($_POST['task_title']) < 3) {
            $error[] = 'Le titre de la tâche doit comporter au moins 3 caractères';
        }
        if (!isset($_POST['user_assigned'])) {
            $error[] = 'Vous devez selectionné un utilisateur';
        }
        if (!isset($_POST['task_priority'])) {
            $error[] = 'La priorité de la tâche doit être égale à Haute, Moyenne ou Faible.';
        }
        if (!isset($_POST['task_description']) || strlen($_POST['task_description']) < 5) {
            $error[] = 'La description de la tâche doit comporter au moins 3 caractères';
        }

        // Vérification des erreurs
        if (count($error) > 0) {
            return $error; // Retourne les erreurs si elles existent
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}
