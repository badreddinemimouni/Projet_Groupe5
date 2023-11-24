<?php

namespace Tp\Project\Forms;

class adminForm
{

    public static function form($action)
    {
        // Assurez-vous que la variable $_GET['id'] est définie pour éviter des erreurs
        $project_id = $_GET['id'];

        // Formulaire pour affecter un utilisateur à un projet
        $form = "<form action='$action' method='POST'>
        <label for='assign_user'>Ajouter un utilisateur au projet</label>
        <input type='text' name='assign_user' class='form' autocomplete='assign_user' required autofocus>
        <input type='hidden' name='id_project' value='" . $project_id . "'>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Ajouter au projet
        </button>
    </form>";
    }

    public static function validateFormAdmin()
    {
        // Validation des données du formulaire
        if (!isset($_POST['assign_user']) || (strlen($_POST['assign_user']) < 3)) {
            return $error = 'Le nom de l\'utilisateur doit comporter au moins 3 caractères'; // Retourne une erreur si il y a une chaîne vide
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}
