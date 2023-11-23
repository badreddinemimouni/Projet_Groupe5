<main>
    <?php
    // Utilisation de certaines classes et namespaces
    use Tp\Project\App\Dispatcher;
    use Tp\Project\App\Model;
    use Tp\Project\Controller\TaskController;

    // Récupération de la valeur de l'identifiant de projet depuis l'URL ($_GET)
    $projectId = $_GET['id'];

    // Affichage d'un lien pour créer une nouvelle tâche associée à un projet spécifique, ce lien pointe vers la méthode 'registerFormTask' du contrôleur 'taskController'
    echo '<a href="' . Dispatcher::generateUrl('taskController', 'registerFormTask', ['project_id' => $projectId]) . '"><button>Créer une nouvelle tâche</button></a>';

    // Pour chaque tâche dans la liste de tâches ($tasks), exécute les instructions suivantes :
    foreach ($tasks as $task)
    {
        // Affichage du titre de la tâche en utilisant la méthode getTitle()
        echo "Titre :" . $task->getTitle();

        // Obtention du libellé de priorité en fonction de la priorité de la tâche
        $priority = Model::getInstance()->getPriorityLabel($task->getPriority());
        echo "Priorité : " . $priority->getPriorityValue() . '<br><br>';

        // Obtention du libellé de statut en fonction du statut de la tâche
        $status = Model::getInstance()->getStatusLabel($task->getStatus());
        echo "Statut : " . $status->getStatusValue() . '<br><br>';
        
        // Formulaire pour changer le statut de la tâche
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
    }
    
    ?>
</main>