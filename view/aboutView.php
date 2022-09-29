<?php $title = "About Us" ;?>

<?php $style = "aboutView";?>

<?php ob_start(); ?>
<?php include(ROOT . "/view/header.php"); ?>

<div class="landing-box">
    <div class="about">
        <h1>About</h1>
        <br>
        <p>
            Dear Diary is a journaling app for the iPhone, iPad and Mac. From once-in-a-lifetime events 
            to everyday moments, Dear Diary’s elegant interface makes journaling your life a simple 
            pleasure. <br>
            <br>
            Dear Diary launched on the iOS and Mac App Stores in 2022 to fill a need: record and store 
            the important memories, photos, and details of life. The response to Dear Diary has been 
            overwhelming: Over ten million downloads, Editor’s Choice, App of the Year, Apple Design 
            Award, and, most of all, a solid 4.8-star rating from our fantastic users.
        </p>
    </div>
    <br>
    <div class="team">
        <h1>Team</h1>
        <br>
        <p>
            The Dear Diary Team is a talented group of engineers and specialists, working remotely from 
            across the world. <br>
            <br>
            Feel free to <a href="#">contact</a> us.</p>
    </div>
    <br>
    <div class="products">
        <h1>Dear Diary Products</h1>
        <br>
        <h4>PC</h4>
        <p>
            This award-winning app is packed with powerful features, including a map view, quick entry 
            menu bar, and timeline filters. Learn more.
        </p>
        <br>
        <h4>Phone and Ipad</h4>
        <p>
            Journal on-the-go using your iOS devices. Never lose the context of “when, where, and what”
            with automatic date, time, location, weather, and motion activity metadata.
        </p>
    </div>

</div>

<?php include(ROOT . "/view/footer.php"); ?>

<?php $content = ob_get_clean(); ?>
<?php 
require("journeyTemplate.php"); 
?>
<?php 
// require("template.php"); 
?>