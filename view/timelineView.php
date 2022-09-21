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

    <div class="group" onclick="">Monthly</div>
    
        <div class="entryMonths">
            <?php
            // number of months from the current month to display
            $numOfMonths = 5;
            $monthsToDisplay = displayMonths($numOfMonths);
            foreach($monthsToDisplay as $month){
                // check if there are entries from that month
                if (array_key_exists($month, $entries)){
            ?>
                    <div class="month">
                        <div class="monthName"><?=$month." ".$entries["$month"][0]['year']?></div>
                        <div class="monthContainer">
                            <?php
                            foreach($entries["$month"] as $entry){
                                include "timeTempView.php";
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>