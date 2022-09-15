<?php $title = "Entry";?>
<?php $style = "entry" ?>
<?php ob_start();?>
  


<!-- <div type="checkbox" id="darkMode" class="darkMode">Toggle</div>
    <label for="darkMode">
 -->



<div class="entry-box">
    <h1><strong>CREATE A NEW ENTRY</strong></h1>
    <div class="form__group field">
        <input type="input" class="form__field"  name="name" id='name' required />
        <label for="name" class="form__label">Entry Title</label>
    </div>
    <div class="calendar">
        <i class="fa-light fa-calendar"></i>
        <input type="date">
    </div>
    <div class="location">
        <i class="fa-light fa-location-dot"></i>
        <input type="text">
    </div>
    <div class="weather">
        <i class="fa-light fa-cloud"></i>
        <input type="text">
    </div>
    <div class="entry-container">
        <input type="text" id="entry" name="entry">
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>