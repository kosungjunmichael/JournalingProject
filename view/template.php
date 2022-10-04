<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <?php if (isset($style)) { ?>
            <link rel="stylesheet" href="<?= BASE .
            	"/public/css/$style.css" ?>">
        <?php } ?>
        <!-- Old Icon -->
        <!-- <link rel="icon" href="../public/images/assets/logo.png"> -->
        <!-- Boxicons Link -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!--    Phosphor Icons Link -->
        <script src="https://unpkg.com/phosphor-icons"></script>
        <!-- Font awesome icons Link -->
        <script src="https://kit.fontawesome.com/04e3b8115d.js" crossorigin="anonymous"></script>
        <!-- DayJS -->
        <script defer src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/weekday.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/weekOfYear.js"></script>
        <!--  global javascript file  -->
        <script defer src=" <?= BASE . "/public/js/script.js" ?> "></script>
        <!-- Page specific javascript file -->
        <?php if (isset($script)) { ?>
            <script defer src="<?= BASE . "/public/js/$script.js" ?>"></script>
        <?php } ?>
        <link rel="icon" href="<?= BASE . "/public/images/static/logo.png" ?>">
    </head>
    <body> <?= $content ?> </body>
</html>