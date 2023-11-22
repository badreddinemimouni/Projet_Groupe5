
<main>
    <?php
    foreach ($tasks as $task) {
        echo "Titre :" . $task->getTitle();
    }
    ?>
</main>