<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\AdminForm;

class AdminController extends AbstractController
{
    public function registerFormAdmin(): void
    {
        $vars = [
            'form' => adminForm::form('?controller=adminController&method=assignUser'),
        ];
        $this->render('admin.php', $vars);
    }
    // L'admin ajoute un user au projet
    public function assignUser()
    {
        // Vérifier si les données du formulaire sont présentes
        if (isset($_POST['assign_user']) && isset($_POST['id'])) // il se réfère ici à l'identifiant du projet
        {
            $userData = Model::getInstance()->getByAttribute('users', 'login', $_POST['assign_user']);

            if (empty($userData)) {
                // Créer l'utilisateur s'il n'existe pas
                $userData = [
                    'password' => $_POST['assign_user'],
                    'login' => $_POST['assign_user'],
                ];
                // Insérer l'utilisateur dans la table 'users'
                $user = Model::getInstance()->save('users', $userData);
            }

            $userData = Model::getInstance()->getByAttribute('users', 'login', $_POST['assign_user']);
            $userId = $userData[0]->getUserId();

            if ($userId) {
                $participateData = [
                    'id' => $_POST['id'],
                    'user_id' => $userId,
                ];

                Model::getInstance()->save('participate', $participateData);
            }
        }
    }
}
