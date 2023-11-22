<main>
    <?php

    use Tp\Project\App\Dispatcher;

    echo '<a href="' . Dispatcher::generateUrl('projectController', 'registerFormProject') . '">Ajouter un projet</a><br><br>';
    foreach ($projects as $project) {
        echo 'Titre : ' . $project->getName() . ' ';
        echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Voir les tâches</a> <br><br> ';
    }
    ?>
</main>