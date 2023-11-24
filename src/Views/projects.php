<main>
    <?php

    use Tp\Project\App\Dispatcher;
    use Tp\Project\App\Model;

    if (isset($_SESSION['connected'])) {

        // Lien pour ajouter un nouveau projet
        echo '<a href="' . Dispatcher::generateUrl('projectController', 'registerFormProject') . '">Ajouter un projet</a><br><br>';

        // Pour chaque projet dans la liste de projets ($projects), exécute les instructions suivantes :
        foreach ($projects as $project) {
            // Affiche le nom du projet

            echo 'Titre : ' . $project->getName() . ' ';
            $userId = $_SESSION['user_id'];
            $adminId = Model::getInstance()->getAttributeByAttribute('admin', 'id_admin', 'user_id', $userId);
            $projectId = $project->getId();
            $projectAdminId = $project->getIdAdmin();
            $isAdmin = $projectAdminId === $adminId;
            $participates = Model::getInstance()->getByAttribute('participate', 'id', $projectId);
            // On Affiche chaque tache
            foreach ($participates as $participate) {
                // Si l'user de la session participe au projet on lui montre les taches
                if ($participate->getUserId() === $userId) {
                    echo '<a href="' . Dispatcher::generateUrl('taskController', 'displayTasksByProject', ['id' => $project->getId()]) . '">Voir les tâches</a> <br><br> ';
                    // Si l'user est admin du projet on lui donne la possibilite d'ajouter un utilisateur
                    if ($isAdmin) {
                        echo '<a href="' . Dispatcher::generateUrl('adminController', 'registerFormAdmin', ['id' => $project->getId()]) . '">Ajouter un utilisateur</a> <br><br> ';
                    }
                }
            }
            // Lien pour voir les tâches liées à ce projet spécifique
        }
    } else {
        Dispatcher::redirect('usersController', 'connectUser');
    }
    ?>
</main>