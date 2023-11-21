<main>
    <?php
    include_once(__DIR__ . './header.php');
    foreach ($tasks as $task) {
        echo "Titre :" . $task->getTitle();
    }
    ?>
</main>