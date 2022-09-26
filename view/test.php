<!-- <?php for($y = 0; $y <= count($month_arr); $y++){
    if($month_arr[$y] = $month_created){
        <p><?= $month_created[$y] ?></p>
        <?php
    }
    ?> -->
    
<?php 
    for($y = 0; $y <= count($month_arr); $y++){
        if($month_arr[$y] === $month_created){
            echo "<p>{$month_created[$y]}</p>"
        }
    }
?>
