<?php
 
namespace Tp\Project\Forms;
 
class projectForm
{
    public static function form($action)
    {
        $form = "<form action= $action method='POST'>
        <label for='project'>Nom du projet</label>
        <input type='text' name='project' class='form' autocomplete='project' required autofocus>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Créer mon projet
        </button>
    </form>";
        return $form;
    }

    public static function validateFormProject()
    {
        if (isset($_POST['project']) && strlen($_POST['project']) < 3) {
            return $error = 'Le titre du projet doit comporter au moins 3 caractères';
        }
        return true;
    }
}