<?php

namespace Tp\Project\Forms;

use Tp\Project\App\Model;

class projectForm
{
    public static function form($action)
    {
        // Formulaire de création de projet
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
        // Validation de la longueur du titre du projet
        if (!isset($_POST['project']) || strlen($_POST['project']) < 3) {
            return $error = 'Le titre du projet doit comporter au moins 3 caractères';
        } else {
            // Vérification de l'existence du projet
            $projectExists = Model::getInstance()->getByAttribute('project', 'name', ($_POST['project']));
            if ($projectExists) {
                return $error = 'Projet déjà existant';
            }
        }
        return true; // Retourne true si aucune erreur n'est détectée
    }
}
