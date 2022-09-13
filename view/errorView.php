<?php $title = "Error"; ?>

<?php ob_start(); ?>

    <div>
        <h2>Error: </h2>
        <h3><?= $errorMessage ?></h3>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>