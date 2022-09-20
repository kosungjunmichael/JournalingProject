<?php $title = "Timeline";?>
<?php $style = "timeline";?>
<?php $script = "timeline";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<?php
    if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'registered') {
        // this should be turn into a little notification modal thing
        echo "<p>You have been registered. Welcome!</p>";
    }
?>

<div id="timeline">

    <h1>Timeline</h1>
    
    <h2>Month</h2>
    <div class="monthContainer">
        <?php
        

            print_r($entries);
            // foreach($entries as $entry){
            //         include "timeTempView.php";
            //     }

        
        ?>
    </div>
    <!-- <div class="month1">
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
    </div>

    <h2>Month</h2>
    <div class="month2">
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
    </div>
    
    <h2>Month</h2>
    <div class="month3">
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5></div>
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
        <div class="container">
            <h3>title of the entry</h3>
            <p>content of the entry</p>
            <h5>hashtangs</h5>
            <h5>date</h5>
        </div>
    </div> -->
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>