<?php

namespace Tp\Project\App;

use Tp\Project\App\UrlGenerator;


//Class that create the header
class Header
{
    public function displayHeader()
    {
?>
        <!-- Header with some bootstraps -->
        <header>
            <nav>
                <ul class="">
                    <li class=""><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('IndexController', 'index'); ?>">Accueil</a></li>
                    <li class=""><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ConnexionController', 'connexion'); ?>">Se connecter</a></li>
                    <li class=""><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'inscription'); ?>">S'enregistrer</a></li>
                    <li class=""><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'dexonnexion'); ?>">Se déconnecter</a></li>
                </ul>
            </nav>
        </header>




<?php
    }
}
