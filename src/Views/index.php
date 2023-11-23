<!DOCTYPE html>
<html>

<body>
    <?php
    // Inclusion du fichier 'header.php' pour afficher l'en-tête de la page
    include_once(__DIR__ . './header.php');
    echo "Bienvenue sur notre moche site !";


    // Vérification de la présence d'une vue à afficher
    if ($view === null) {
        $main = '/main.php'; // Si aucune vue spécifique n'est définie, utilise par défaut 'main.php'
    } else {
        $main = $view; // Utilise la vue spécifiée
    }

    // Inclusion du fichier de vue principal à afficher dans la balise body
    include_once(__DIR__ . $main);
    ?>
</body>

</html>