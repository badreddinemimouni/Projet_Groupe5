<main>
    <?php

    use Tp\Project\App\Dispatcher;

    // Lien pour ajouter un nouveau projet
    echo '<a href="' . Dispatcher::generateUrl('projectController', 'registerFormProject') . '">Ajouter un projet</a>';

    // Pour chaque projet dans la liste de projets ($projects), exécute les instructions suivantes :
    foreach ($projects as $project) {
        // Affiche le nom du projet
        echo 'Titre : ' . $project->getName() . '<br><br>';
        
        // Lien pour voir les tâches liées à ce projet spécifique
        echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Voir les tâches</a>';
    }
    ?>
</main>