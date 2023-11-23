<main>
    <?php
    // Utilisation de certaines classes et namespaces
    use Tp\Project\App\Dispatcher;
    use Tp\Project\App\Model;
    use Tp\Project\Controller\TaskController;

    // Récupération de la valeur de l'identifiant de projet depuis l'URL ($_GET)
    $projectId = $_GET['id'];
    $userId = $_SESSION['user_id'];
    $adminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
    $project = Model::getInstance()->getOneByAttribute('project', 'id', $projectId);
    $projectAdminId = $project->getIdAdmin();
    $isAdmin = $adminId === $projectAdminId;



    // Affichage d'un lien pour créer une nouvelle tâche associée à un projet spécifique, ce lien pointe vers la méthode 'registerFormTask' du contrôleur 'taskController'
    echo '<a href="' . Dispatcher::generateUrl('taskController', 'registerFormTask', ['project_id' => $projectId]) . '"><button>Créer une nouvelle tâche</button></a><br><br>';
    // Pour chaque tâche dans la liste de tâches ($tasks), exécute les instructions suivantes :
    foreach ($tasks as $task) {
        $isAssigned = $userId === $task->getUserId();

        if ($isAdmin || $isAssigned) {
            // Affichage du titre de la tâche en utilisant la méthode getTitle()
            echo "Titre :" . $task->getTitle() . ' <br><br>';

            // Obtention du libellé de priorité en fonction de la priorité de la tâche
            $priority = Model::getInstance()->getPriorityLabel($task->getPriority());
            echo "Priorité : " . $priority->getPriorityValue() . ' <br><br>';

            // Obtention du libellé de statut en fonction du statut de la tâche
            $status = Model::getInstance()->getStatusLabel($task->getStatus());
            echo "Statut : " . $status->getStatusValue() . ' <br><br>';

            if ($isAdmin) {
                echo '<a href="' . Dispatcher::generateUrl('taskController', 'UpdateFormTask', ['id_task' => $task->getId()]) . '"><button>Modifier</button></a><br><br>';
            }
        }
    }

    ?>
</main>