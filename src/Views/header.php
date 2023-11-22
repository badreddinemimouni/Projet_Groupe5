<?php
include_once('vendor/autoload.php');

use Tp\Project\App\Dispatcher;
use Tp\Project\App\Security;
?>

<header>
    <nav>
        <ul class="">
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('IndexController', 'index'); ?>">Accueil</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('usersController', 'connectUser'); ?>">Se connecter</a></li>
            <li class=""><a class="nav-link text-light" href="<?php Dispatcher::Dispatch('usersController', 'registerUser'); ?>">S'enregistrer</a></li>
            <?php
            if (Security::is_connected()) {
                echo '<li class=""><a class="nav-link text-light" href="' . Dispatcher::Dispatch('Security', 'disconnect') . '">Se déconnecter</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>