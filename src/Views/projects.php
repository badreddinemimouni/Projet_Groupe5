<main>
    <?php
    include_once(__DIR__ . './header.php');
    foreach ($projects as $project) {
        echo "Titre :" . $project->getName();
    }
    ?>
</main>