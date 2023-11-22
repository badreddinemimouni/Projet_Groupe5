<main>
    <?php

    use Tp\Project\App\Dispatcher;

    echo '<a href="' . Dispatcher::generateUrl('projectController', 'registerFormProject') . '">Ajouter un projet</a>';
    foreach ($projects as $project) {
        echo 'Titre : ' . $project->getName() . '<br><br>';
        echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Voir les tâches</a>';
    }
    ?>
</main>