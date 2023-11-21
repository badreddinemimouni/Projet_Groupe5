<?php
namespace Tp\Project\App;
use Tp\Project\App\Model;
class Security{
    public static function verifyUser($login){
        // echo 'retoetn';
        $user = Model::getInstance()->getByAttribute('users','login',$login);
        var_dump($user);
        if(!empty($user)){
            return true;
        }
        return false;
    }
    public static function getPassword($user){
        $password = Model::getInstance()->getByAttribute('users','login',$user)[0]['password'];
        return $password;



    }

}
new Security();
echo Security::verifyUser('badr');