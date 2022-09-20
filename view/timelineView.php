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
    // print_r($_SESSION['uid']);
?>

<div id="timeline">

    <div class="title">Timeline</div>
    
    <div class="entryMonths">
        <?php
        // number of months from the current month to display
        $numOfMonths = 5;
        $monthsToDisplay = displayMonths($numOfMonths);
        foreach($monthsToDisplay as $month){
            // check if there are entries from that month
            if (array_key_exists($month, $entries)){
                echo "<div class='month'>";
                echo "<h3>$month</h3>";
                echo "<div class='monthContainer'>";
                foreach($entries["$month"] as $entry){
                    include "timeTempView.php";
                }
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </div>
    
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>