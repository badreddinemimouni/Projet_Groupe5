
<main>
    <?php

    use Tp\Project\App\Dispatcher;

    foreach ($tasks as $task) 
    {
        echo "Titre :" . $task->getTitle();
        echo "Priorité : " . $task->getPriority() . '<br><br>';
        echo '<a href="' . Dispatcher::generateUrl('taskController', 'registerFormTask') . '"><button>Créer une nouvelle tâche</button></a>';
    }
    ?>

</main>