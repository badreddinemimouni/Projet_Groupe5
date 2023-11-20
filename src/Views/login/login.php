<main class="form-signin w-100 m-auto">
    <h2 class="h3 mb-3 font-weight-normal"><?php echo $title; ?></h2>
    <?php
        if($error) {
            echo $error.'<br>';
        }
        echo $form;
    ?>
</main>