<?php $title = "Album";?>
<?php $style = "album";?>
<?php ob_start();?>
<?php include("sidebarView.php");?>

<div id="album"></div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
