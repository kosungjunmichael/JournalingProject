<?php $title = "Album";?>
<?php $style = "album";?>
<?php ob_start();?>
<?php include("sidebarView.php");?>

<h1>Album</h1>
<div id="album-container">
    <div class="pic-place">
        <img src="https://source.unsplash.com/1600x900/?people" alt="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>