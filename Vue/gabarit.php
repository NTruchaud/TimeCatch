<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Nécessaire pour un rendu optimal sous IE -->
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->

        <!-- Elément déplacé  -->
        <base href="<?= $racineWeb ?>" >
        
        <!-- Feuilles de style -->
        <link rel="stylesheet" href="Librairies/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="Contenu/style.css">

        <!-- Favicon -->
        <link rel="shortcut icon" href="Contenu/Images/favicon.ico">

        <!-- Titre -->
        <title>Time Catch - <?= $titre ?></title>

    </head>
    <body>
        <div class="container">
            <?= $contenu ?>
        </div>

        <!-- jQuery -->
        <script src="Librairies/jquery/jquery-1.10.2.min.js"></script>
        <!-- Plugin JavaScript Boostrap -->
        <script src="Librairies/bootstrap/js/bootstrap.min.js"></script>
        <!-- Plugin Parse Core -->
        <script src="Librairies/parse/composer.json"></script>
    </body>



</html>
