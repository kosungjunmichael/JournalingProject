<?php $title = "Calendar";?>
<?php $style = "calendar";?>
<?php $script = "calendar";?>
<?php ob_start();?>
<?php include("sidebarView.php");?>
    <div id="calendar-wrap">
        <div class="page-header">
            <h2 class="page-header-text">Calendar</h2>
        </div>
        <div id="calendar"></div>
        <div id="calendar-mobile-details-container" class="hidden"></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>