<?php $title = "Entry";?>
<?php $style = "entry";?>
<?php $usrID = $_GET['usr']?>
<?php ob_start();?>

<?php include("sidebarView.php");?>

<div class="entry-box">
    <form action="../index.php?action=entries&usr=<?= $usrID?>" method="post" class="form-container">
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

        <div class="entry-upload-photo">
        </div>
        
        <div class="entry-bottom">
            <div class="entry-photo">
                <input type="file" id="file" accept="image/*"/>
                <label for="file"><p>+</p>Add photo</label>
            </div>
            <div class="entry-submit">
                <input type="submit"/>
            </div>
        </div>
    </form>
</div>



<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>