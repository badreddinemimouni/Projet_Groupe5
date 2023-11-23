<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\AdminForm;
use Tp\Project\App\Dispatcher;

class AdminController extends AbstractController
{
    // Méthode pour afficher le formulaire d'ajout d'utilisateur au projet par un admin
    public function registerFormAdmin(): void
    {
        // Crée une variable $vars contenant le formulaire d'ajout d'utilisateur au projet
        $vars = [
            'form' => adminForm::form('?controller=adminController&method=assignUser'),
        ];
        // Affiche la vue "admin.php" avec le formulaire d'ajout d'utilisateur
        $this->render('admin.php', $vars);
    }

    // Méthode pour assigner un utilisateur à un projet par l'admin
    public function assignUser()
    {
        // Vérifier si les données du formulaire sont présentes
        if (isset($_POST['assign_user']) && isset($_POST['id'])) // il se réfère ici à l'identifiant du projet
        {
            // Récupère les données de l'utilisateur à partir du formulaire
            $userData = Model::getInstance()->getByAttribute('users', 'login', $_POST['assign_user']);

            // Si l'utilisateur n'existe pas, crée le
            if (empty($userData)) {
                $userData = [
                    'password' => password_hash($_POST['assign_user'], PASSWORD_DEFAULT),
                    'login' => $_POST['assign_user'],
                ];
                // Sauvegarde l'utilisateur dans la base de données
                $user = Model::getInstance()->save('users', $userData);
            }

            // Récupère l'identifiant de l'utilisateur
            $userData = Model::getInstance()->getByAttribute('users', 'login', $_POST['assign_user']);
            $userId = $userData[0]->getUserId();

            // Si l'identifiant de l'utilisateur est récupéré avec succès, l'assigne au projet
            if ($userId) {
                $participateData = [
                    'id' => $_POST['id'], // Identifiant du projet
                    'user_id' => $userId, // Identifiant de l'utilisateur
                ];
                // Associe l'utilisateur au projet dans la table 'participate'
                Model::getInstance()->save('participate', $participateData);
            }
            Dispatcher::redirect('projectController', 'displayProjectsByUserId');
        }
    }
}