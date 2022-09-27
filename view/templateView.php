<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= BASE . "/public/css/$style.css"; ?>">
    <link rel="icon" href="../public/images/logo.png">
    <!-- Boxicons Link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!--    Phosphor Icons Link -->
    <script src="https://unpkg.com/phosphor-icons"></script>
    <!--  Font awesome icons Link  -->
    <script src="https://kit.fontawesome.com/04e3b8115d.js" crossorigin="anonymous"></script>
    <!--  global javascript file  -->
    <script defer src=" <?= BASE . "/public/js/script.js"; ?> "></script>
    <!-- Page specific javascript file -->
    <?php if (isset($script)) {
        echo "<script defer src='" . BASE . "/public/js/" . $script . ".js'></script>";
    }?>
    <link rel="icon" href="<?= BASE . "/public/images/static/logo.png"?>">
</head>

<body> <?= $content; ?> </body>

</html>