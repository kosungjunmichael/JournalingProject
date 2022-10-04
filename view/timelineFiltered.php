<?php
    // if ($entries) {
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
    // }
    ?>