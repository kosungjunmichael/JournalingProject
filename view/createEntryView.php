<?php 
// session_start();

if (!isset($_SESSION['uid'])){
    throw new Exception("401 - Unauthorized");
}
?>
<?php $title = "Create New Entry";?>
<?php $style = "createEntry";?>
<?php $script = "script";?>

<?php ob_start();?>

<?php include("sidebarView.php");?>

<div class="entry-box">
    <form action="<?=BASE . "/index.php?action=addNewEntry"?>" method="post" class="form-container" enctype="multipart/form-data">
        <h2>CREATE A NEW ENTRY</h2>
        <div class="entry-title">
            <input type="text" id="title" name="title" placeholder="Entry Title"/>
        </div>

        <div class="entry-date">
            <i class='bx bx-calendar'></i>
            <input type="date"/>
        </div>

        <div class="entry-location">
            <i class='bx bx-current-location' ></i>
            <input type="" placeholder="location"/>
        </div>

        <div class="entry-weather">
            <input type="" placeholder="weather"/>
        </div>

        <div class="entry-writing">
            <textarea type="text" id="entry" name="entry" placeholder="Start Writing..."></textarea>
        </div>

        <div class="entry-bottom">
            <div class="entry-upload-photo">
            </div>
            <?php include("uploadImageView.php");?>
            <div class="entry-submit">
                <input type="submit" name="submit"/>
            </div>
        </div>
    </form>
</div>



<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>