<?php
include_once('vendor/autoload.php'); // Charge automatiquement les classes et les dépendances du projet via Composer
 
use Tp\Project\App\Dispatcher;
?>
 
<header>
    <nav>
        <ul class="">
            <!-- Génére les URLs vers différentes actions de contrôleurs de l'application lorsque ces liens de navigation sont cliqués -->
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('IndexController', 'index'); ?>">Accueil</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('ConnexionController', 'connexion'); ?>">Se connecter</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('usersController', 'createUser'); ?>">S'enregistrer</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('SecurityController', 'deconnexion'); ?>">Se déconnecter</a></li>
        </ul>
    </nav>
</header>