<main>
    <?php

    use Tp\Project\App\Dispatcher;
    use Tp\Project\App\Model;
    use Tp\Project\Controller\TaskController;

    $projectId = $_GET['id'];

    echo '<a href="' . Dispatcher::generateUrl('taskController', 'registerFormTask', ['project_id' => $projectId]) . '"><button>Créer une nouvelle tâche</button></a>';

    foreach ($tasks as $task)
    {
        echo "Titre :" . $task->getTitle();

        $priority = Model::getInstance()->getPriorityLabel($task->getPriority());
        echo "Priorité : " . $priority->getPriorityValue() . '<br><br>';

        $status = Model::getInstance()->getStatusLabel($task->getStatus());
        echo "Statut : " . $status->getStatusValue() . '<br><br>';
        
        //form change Task Status
        echo "<form action='" . Dispatcher::generateUrl('taskController', 'displayTasksByProject') . "' method='POST'>";
        echo "<input type='hidden' name='task_id' value='" . $task->getId() . "'>"; // Ajoute un champ caché pour l'id de la tâche
        echo "<label for='status'></label>";
        echo "<select name='status' class='form' required autofocus>";
        echo "<option value='' disabled selected hidden>Choisir le statut</option>";
        echo "<option value='1'>Non débuté</option>";
        echo "<option value='2'>En cours</option>";
        echo "<option value='3'>Terminé</option>";
        echo "</select>";
        echo "<button type='submit' name='submit'> Changer Statut </button>";
        echo "</form>";
        
         //echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Créer ma tâche</a> <br><br> ';

    }
    
    ?>
</main>