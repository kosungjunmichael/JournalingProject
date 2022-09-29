<?php $title = "Calendar"; ?>
<?php $style = "calendar"; ?>

<?php ob_start(); ?>

<?php include "sidebarView.php"; ?>

<div id="calendarview-container">
<h2 >Calendar</h2>
</div>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>