<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\App\AbstractController;
use Tp\Project\Forms\AdminForm;
// use Tp\Project\Entity\Users;

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
            
            if (empty($userData)) 
            {
                // Créer l'utilisateur s'il n'existe pas
                $userData = [
                    'password' => 'tata', // À remplacer par la méthode appropriée pour sécuriser le mot de passe
                    'login' => $_POST['assign_user'],
                ];
                // Insérer l'utilisateur dans la table 'users'
                $user = Model::getInstance()->save('users', $userData);
            }

            $userData = Model::getInstance()->getByAttribute('users', 'login', $_POST['assign_user']);
            $userId = $userData[0]->getUserId();

            if ($userId) 
            {
                $participateData = [
                    'id' => $_POST['id'],
                    'user_id' => $userId,
                ];

                 Model::getInstance()->save('participate', $participateData);
            }
        }
    }
}


/*      
        // si l'user existe
        if (isset($_POST['assign_user']) && isset($_POST['id'])) { // ajout de l'user au projet
            $datas = [
                'id' => $_POST['id'],
                'user_id' => $_POST['user_id'],
            ];
            adminForm::validateFormAdmin(); // appele la méthode statique validateFormAdmin de la classe adminForm.
            Model::getInstance()->save('participate', $datas); // met les données rentrées dans le form dans la BDD

        } else { // création de l'user
            $datas = [
                'password' => 'toto',
                'login' => $_POST['assign_user'],
            ];
            adminForm::validateFormAdmin(); // appele la méthode statique validateFormAdmin de la classe adminForm.
            Model::getInstance()->save('users', $datas); // met les données rentrées dans le form dans la BDD
        }
*/








/* 
        else {
                // Gérer l'échec de création ou récupération de l'utilisateur
                // Peut-être une redirection ou un message d'erreur approprié
            }
        } else {
            // Gérer le cas où les données du formulaire ne sont pas complètes
            // Peut-être une redirection ou un message d'erreur approprié
        } 
*/















/* 
        $datas = [
            'password' => 'toto',
            'login' => $_POST['assign_user'],
        ];
    
        $validationMessage = adminForm::validateFormAdmin(); // appele la méthode statique validateFormAdmin de la classe adminForm.
            if ($validationMessage === true) {
                Model::getInstance()->save('users', $datas);
            } else {
                echo $validationMessage . '<br><br>';
            }
        } 
*/