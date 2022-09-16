<?php $title = "HomePage"; ?>
<?php $style = "indexView";?>
<?php ob_start(); ?>

<div class="design">
    <img src="" alt="">
    <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
        when an unknown printer took a galley of type and scrambled it to make a type
        specimen book. 
    </p>
</div>


<?php $content = ob_get_clean(); ?>
<?php require("templateView.php"); ?>



