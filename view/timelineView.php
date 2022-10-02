<?php $title = "Timeline";?>
<?php $style = "timeline";?>
<?php $script = "timeline";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<?php
    if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'registered') {
        // TODO:this should be turn into a little notification modal thing
        echo "<p>You have been registered. Welcome!</p>";
    }
    // print_r($_SESSION['uid']);
?>

<main id="timeline">

    <h1 class="title">Timeline</h1>
    <div class="filter-field">
        <div class="filter-input-field">
            <div class="filter-input-control">
                <i class="ph-funnel"></i>
                <ul class="filter-cont"></ul>
                <input type="text" name="search_bar" class="search-bar" placeholder="Type Filter & Press Enter">
            </div>
            <button class="filter-btn">Filter</button>
            <button class=filter-remove-all>Remove All<i class="ph-trash"></i></button>
        </div>
        <div class="filter-switch-cont">
            <button class="filter-tags-switch switch-active">tags</button>
            <button class="filter-titles-switch">title</button>
            <button class="filter-entries-switch">entries</button>
        </div>
    </div>
    <div class="switch-toggle">
        <?php 
            if ($view === "weekly") {
                ?>
                <div class="group">Weekly</div>
                <a href="index.php?action=toggleView&view=month">
                    <div class="group">Monthly</div>
                </a>
                <?php
            } else if ($view === "monthly") {
                ?>
                <!-- <a href="index.php?action=toggleView&view=week">
                    <div class="group">Weekly</div>
                </a> -->
                <!-- <div class="group">Monthly</div> -->
                <?php
            }
        ?>
    </div>
    <?php
    // TODO: change the code depending on the way we're formatting the weekly & monthly
    if ($view === 'weekly'){
    ?>
         <!-- <section class="entry-display"> -->
    <?php
    } else if ($view === 'monthly'){
        ?>
         <section class="entry-display">
    <?php
    }
    ?>
            <?php
            if ($entries AND $view === "monthly") {
                // number of months from the current month to display
                $numOfMonths = 5;
                $monthsToDisplay = displayMonths($numOfMonths);
                // september, august, 
                foreach($monthsToDisplay as $month){
                    // check if there are entries from that month
                    if (array_key_exists($month, $entries)){
            ?>
                        <div class="month">
                            <h2 class="month-name"><?=$month?></h2>
                            <div class="month-container">
                                <?php
                                foreach($entries["$month"] as $entry){
                                    include "timelineTemplate.php";
                                }
                                ?>
                            </div>
                        </div>
            <?php
                    }
                }
            } else if ($view === "weekly") {
                $weeksToDisplay = displayDaysInWeek();
                foreach($weeksToDisplay as $weekDay){
                    // check if there are days in that week
                    if (array_key_exists($weekDay, $entries)){
            ?>
                        <div class="week">
                            <div class="week-name">
                                <?=$weekDay?>
                            </div>
                            <div class="week-container">
                                <?php
                                foreach($entries["$weekDay"] as $entry){
                                    include "timelineTemplate.php";
                                }
                                ?>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="week">
                            <div class="week-name">
                                <!-- <?=$weekDay?> -->
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </section>
</main>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>