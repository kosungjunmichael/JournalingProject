<?php $title = "Journey"; ?>

<?php ob_start(); ?>
    <div class="container">
        <?php
            include('sidebarView.php');
        ?>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require("templateView.php"); ?>