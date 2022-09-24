<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= BASE . "/public/css/journey.css"; ?>">
    <link rel="stylesheet" href="<?= BASE . "/public/css/$style.css"; ?>">

    <!-- Page specific javascript file -->
    <script defer src="<?= BASE . "/public/js/loginSignup.js?>"; ?>"></script>

    <title><?=$title;?></title>
    <link rel="icon" href="<?= BASE . "/public/images/static/logo.png"?>">
</head>

<body> <?= $content; ?> </body>

</html>