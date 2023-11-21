<?php
namespace Tp\Project\Controller;

use Tp\Project\Config\Config;
use Tp\Project\App\Model;
use Tp\Project\Forms\loginForm;
use Tp\Project\App\AbstractController;


class loginController extends AbstractController
{
    public function connectUser(): void
    {
        $vars = [
            'form' => loginForm::constructLoginForm('?controller=loginController&method=connect', 'save'),
        ];

        $this->render('login.php', $vars);
    }

    public function connect(): void {
        
        $datas = [
            'password' => $_POST['password'],

            'login' => $_POST['username'],

        ];
        $ValidConnexion = loginForm::processFormLogin();

        if($ValidConnexion === true){
            Model::getInstance()->save('users',$datas);
            echo 'letsgoo';

        } else{
            foreach ($ValidConnexion as $message){
                echo $message.'<br><br>';
            }
        }

    

    }
}


new loginController();
echo (loginController::connect());
?>

