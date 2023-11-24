<main>
    <!-- Affiche le formulaire d'actualisation de tâche -->
    <?php

    use Tp\Project\App\Dispatcher;

    if (isset($_SESSION['connected'])) {
        echo $form;
    } else {
        Dispatcher::redirect('usersController', 'connectUser');
    }
    ?>
</main>