<?php
include_once('vendor/autoload.php');

use Tp\Project\App\Dispatcher;
use Tp\Project\App\Security;

?>

<header>
    <nav>
        <ul class="">
            <!-- Crée un lien vers la page d'accueil -->
            <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('IndexController', 'index'); ?>">Accueil</a></li>
            <!-- Vérifie si l'utilisateur n'est connecté -->
            <?php if (!Security::is_connected()) { ?>
                <!-- Affiche des liens pour se connecter et s'enregistrer -->
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('usersController', 'connectUser'); ?>">Se connecter</a></li>
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('usersController', 'registerUser'); ?>">S'enregistrer</a></li>
            <?php } else { ?>
                <!-- Affiche des liens pour afficher les projets de l'utilisateur connecté et pour se déconnecter -->
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('projectController', 'displayProjectsByUserId'); ?>">Projets</a></li>
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('usersController', 'disconnect'); ?>">Se déconnecter</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>