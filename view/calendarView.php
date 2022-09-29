<?php $title = "Calendar"; ?>
<?php $style = "calendar"; ?>

<?php ob_start(); ?>

<?php include "sidebarView.php"; ?>

<h1 class="title">Calendar</h1>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>