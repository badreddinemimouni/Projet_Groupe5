<?php
 
namespace Tp\Project\Forms;
 
class adminForm
{
    public static function form($action)
    {
        $form = "<form action= $action method='POST'>
        <label for='assign_user'>Ajouter un utilisateur au projet</label>
        <input type='text' name='assign_user' class='form' autocomplete='assign_user' required autofocus>
        <label for='id'>id</label>
        <input type='text' name='id' class='form' autocomplete='id' required autofocus>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Créer mon projet
        </button>
    </form>";
        return $form;
    }

    public static function validateFormAdmin()
    {
        if (isset($_POST['']) && strlen($_POST['']) < 3) {
            return $error = '';
        }
        return true;
    }
}