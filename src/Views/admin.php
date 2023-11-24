<main>
    <!-- Affiche le formulaire de création de ? -->
    <?php

    use Tp\Project\App\Dispatcher;

    if (isset($_SESSION['connected'])) {

        echo $form;
    } else {
        Dispatcher::redirect('usersController', 'connectUser');
    }
    ?>

</main>