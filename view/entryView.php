<?php $title = "Entry";?>
<?php $style = "entry" ?>
<?php ob_start();?>

<div class="entry-box">
    <h1><strong>CREATE A NEW ENTRY</strong></h1>
    <label for="title">Entry Title</label>
    <input type="text" id="title" name="title">
    <div class="calendar">

    </div>
    <div class="location">

    </div>
    <div class="weather">

    </div>
    <div class="entry-container">
        <label for="entry">Start Writing...</label>
        <input type="text" id="entry" name="entry">
    </div>
</div>






<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>