<!DOCTYPE html>
<html>

<body>
    <?php
    include_once(__DIR__ . './header.php');
    if ($view === null) {
        $main = '/main.php';
    } else {
        $main = $view;
    }
    include_once(__DIR__ . $main);
    
    ?>
</body>

</html>