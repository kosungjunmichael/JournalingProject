<!-- <link rel="stylesheet" href="album.css"/> -->

<?php $title = "Album";?>
<?php $style = "album";?>
<?php $script = "album";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<div class="overlay display-none" onclick="closeModal()"></div>
<div class="modal-container display-none">
<div class="modal display-none">

</div>
</div>
<div id="container"> 
<h1>Album</h1> 
<section id="album-container"> 

<?php

        for($i = 0; $i < count($res); $i++){
            $month_arr = [];
            $path = $res[$i]["paths"];
            $date_created = $res[$i]["date_created"];
            $newDate = date("F j Y", strtotime($date_created));  
            $month_created = date("F Y", strtotime($date_created));  
            $title = $res[$i]["title"];
            array_push($month_arr, $month_created);

            // if($month_created){
            ?>
            <div id="album-container-bottom">
                <?php for($y = 0; $y <= count($month_arr); $y++){
                    if($month_arr[$y] = $month_created){ ?>
                <p><?php $month_created[$y] ?></p>
                <?php
                    }
                }
                ?>
                    <div class="album" onclick="openModal()" style="background-image: url('data:image/jpeg;base64,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')";>
                        <p id="album-title"> <?=$title?> </p>
                        <div class="album-bottom">
                            <p>tag</p>
                            <p><?=$newDate?></p>
                    </div>
                </div> 
            </div>

            <?php
        }
    
        ?>

</section>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
