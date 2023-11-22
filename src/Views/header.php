<?php
include_once('vendor/autoload.php');

use Tp\Project\App\Dispatcher;
use Tp\Project\App\Security;

?>

<header>
    <nav>
        <ul class="">
            <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('IndexController', 'index'); ?>">Accueil</a></li>
            <?php if (!Security::is_connected()) { ?>
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('usersController', 'connectUser'); ?>">Se connecter</a></li>
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('usersController', 'registerUser'); ?>">S'enregistrer</a></li>
            <?php } else { ?>
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('projectController', 'displayProjectsByUserId'); ?>">Projets</a></li>
                <li class=""><a class="nav-link text-light" href="<?php echo Dispatcher::generateUrl('usersController', 'disconnect'); ?>">Se déconnecter</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>