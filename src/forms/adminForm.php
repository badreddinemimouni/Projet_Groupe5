<?php
 
namespace Tp\Project\Forms;
 
class adminForm
{
    
    public static function form($action)
    {
        // Formulaire pour affecter un utilisateur à un projet
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
        // Validation des données du formulaire
        if (isset($_POST['']) && strlen($_POST['']) < 3) {
            return $error = ''; // Retourne une erreur si il y a une chaîne vide
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}