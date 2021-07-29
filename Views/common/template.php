<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description ?>">
    <title><?= $page_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL ?>public\CSS\style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous" defer></script>
    <script src="<?= URL ?>public\JS\DarkMode.js" defer></script>
    <script src="<?= URL ?>public\JS\main.js" defer></script>
</head>
<body class="white">
    <?php require_once('Views/common/header.php'); ?>

<!-- ici on crée une potentielle alerte en dessous du menu et au dessus du contenu -->
    <div class="container">
        <?php
            if(!empty($_SESSION["alert"])){
        ?>
            <div class="alert <?= $_SESSION["alert"]["type"] ?> " role="alert">
                <?= $_SESSION["alert"]["message"] ?>
            </div>
        <?php
            unset($_SESSION["alert"]);
            }
        ?>
    </div>

    <div class="container">
        <?= $page_content ?>
    </div>

    <?php require_once('Views/common/footer.php') ?>


</body>
</html>