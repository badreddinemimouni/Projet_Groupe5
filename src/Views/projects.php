<main>
    <?php

    use Tp\Project\App\Dispatcher;
    use Tp\Project\App\Model;

    echo '<a href="' . Dispatcher::generateUrl('projectController', 'registerFormProject') . '">Ajouter un projet</a><br><br>';
    foreach ($projects as $project) {
        echo 'Titre : ' . $project->getName() . ' ';
        $userId = $_SESSION['user_id'];
        $adminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
        if ($adminId) {
            $projectAdminId = $project->getIdAdmin();
            if ($adminId === $projectAdminId) {
                echo '<a href="' . Dispatcher::generateUrl('adminController', 'registerFormAdmin', ['id' => $project->getId()]) . '">Ajouter un utilisateur</a>  ';
            }
        }
        echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Voir les tâches</a> <br><br> ';
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