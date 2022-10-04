<?php
    if ($group === "monthly") {
        // number of months from the current month to display
        $numOfMonths = 5;
        $monthsToDisplay = displayMonths($numOfMonths);
        // echo "banana";
        // september, august,
        foreach($monthsToDisplay as $month){
          // echo "Hello";
            // check if there are entries from that month
            if (array_key_exists($month, $entries)){
              // echo "apples";
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
    } else if ($group === "weekly") {
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
    