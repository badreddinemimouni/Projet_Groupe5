<main class="form-signin w-100 m-auto">
    <h2 class="h3 mb-3 font-weight-normal"><?php echo $title; ?></h2>
    <?php
        if($error) {
            foreach($error as $e) {
                echo $e.'<br>';
            }
        }
        echo $form;
    ?>
</main>