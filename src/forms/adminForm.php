<?php
 
namespace Tp\Project\Forms;
 
class adminForm
{
    public static function form($action)
    {
        $form = "<form action= $action method='POST'>
        <label for='assign_user'>Ajouter un utilisateur au projet</label>
        <input type='text' name='assign_user' class='form' autocomplete='assign_user' required autofocus>
        <!--
        <label for='create_user'>Créer un utilisateur et l'ajouter au projet</label>
        <input type='text' name='create_user' class='form' autocomplete='create_user' required autofocus>
        <label for='affect_user'>Affecter un utilisateur à une tâche</label>
        <input type='text' name='affect_user' class='form' autocomplete='affect_user' required autofocus>
        -->
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Créer mon projet
        </button>
    </form>";
        return $form;
    }

    public static function validateFormAdmin()
    {
        if (isset($_POST['create_user']) && strlen($_POST['create_user']) < 3) {
            return $error = 'Le titre du projet doit comporter au moins 3 caractères';
        }
        return true;
    }
}