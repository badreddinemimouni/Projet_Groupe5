<main>
    <?php

    use Tp\Project\App\Dispatcher;
    use Tp\Project\App\Model;

    echo '<a href="' . Dispatcher::generateUrl('projectController', 'registerFormProject') . '">Ajouter un projet</a><br><br>';
    foreach ($projects as $project) {
        echo 'Titre : ' . $project->getName() . ' ';
        $userId = $_SESSION['user_id'];
        $admin = Model::getInstance()->getByAttribute('admin', 'user_id', $userId);
        if (!empty($admin)) {
            $adminId = $admin[0]->getId();
            $projectAdminId = $project->getIdAdmin();
            if ($adminId === $projectAdminId) {
                echo '<a href="' . Dispatcher::generateUrl('adminController', 'registerFormAdmin', ['id' => $project->getId()]) . '">Ajouter un utilisateur</a>  ';
            }
        }
        echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Voir les tâches</a> <br><br> ';
    }
    ?>
</main>