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
    public function assignUser() {
        $datas = [
            'login' => $_POST['assign_user'],
        ];
        $validationMessage = adminForm::validateFormAdmin(); // appele la méthode statique validateFormProject de la classe projectForm.
            if ($validationMessage === true) {
                Model::getInstance()->save('admin', $datas);
            } else {
                echo $validationMessage . '<br><br>';
            }
    }
}
// L'admin ajoute et crée un user au projet et l'affecte à une tâche