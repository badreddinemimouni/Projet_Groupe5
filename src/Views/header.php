<?php
include_once('vendor/autoload.php');

use Tp\Project\App\Dispatcher;
?>

<header>
    <nav>
        <ul class="">
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('IndexController', 'index'); ?>">Accueil</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('ConnexionController', 'connexion'); ?>">Se connecter</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('usersController', 'createUser'); ?>">S'enregistrer</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('SecurityController', 'deconnexion'); ?>">Se déconnecter</a></li>
        </ul>
    </nav>
</header>