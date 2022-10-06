<?php $title = "Timeline";?>
<?php $style = "timeline";?>
<?php $script = "timeline";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<main id="timeline">

<header class="alertBar">
    <?php
    if (isset($alert)) {
        // TODO:this should be turn into a little notification modal thing
        echo "$alert";
    }
    ?>
</header>
 
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
            <h2 class='filter-label'>Filter By</h2>
            <div class="filter-switches">
                <button class="switch tags switch-active">Tags</button>
                <button class="switch titles">Titles</button>
                <button class="switch entries">Entries</button>
            </div>
            <div class="display-toggle">
        <h2 class='group-label'>Group By</h2>
        <div class="display-cont">
            <?php
                    if ($view === "weekly") {
                        ?>
                        <div class="display-tag switch-active">Weekly</div>
                        <a href="index.php?action=toggleView&view=month">
                            <div class="display-tag">Monthly</div>
                        </a>
                        <?php
                    } else if ($view === "monthly") {
                        ?>
                        <a href="index.php?action=toggleView&view=week">
                            <div class="display-tag">Weekly</div>
                        </a>
                        <div class="display-tag switch-active">Monthly</div>
                        <?php
                    }
                ?>
            </div>
        </div>
        </div>
    </div>
    <div class="entry-display">

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
                        <div class="group">
                            <h3 class="group-name"><?=$month?></h3>
                            <div class="group-container">
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
                        <div class="group">
                            <h3 class="group-name"><?=$weekDay?></h3>
                            <div class="group-container">
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
                        <!-- <div class="group"> -->
                            <!-- <h3 class="group-name"><?=$weekDay?></h3> -->
                        <!-- </div> -->
            <?php
                    }
                }
            }
            ?>
        </section>
</main>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>