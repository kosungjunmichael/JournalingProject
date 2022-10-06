<!-- <link rel="stylesheet" href="album.css"/> -->

<?php $title = "Album"; ?>
<?php $style = "album"; ?>
<?php $script = "album"; ?>

<?php ob_start(); ?>
<?php include "sidebarView.php"; ?>

<div id="container"> 
<h1 id="album-page-title">Album</h1> 
<section id="album-container"> 

<?php
$month_arr = [];
for ($i = 0; $i < count($res); $i++) {

	$date_created = $res[$i]["date_created"];
	$month_created = date("F Y", strtotime($date_created));
	$path_raw = $res[$i]["paths"];
	$path = explode(",", $path_raw);
	$newDate = date("F j, Y", strtotime($date_created));
	$month_name = date("F", strtotime($date_created));
	$title = $res[$i]["title"];
	$tagStr = $res[$i]["tags"];
	$tags = explode(",", $tagStr); // if the month_created is NOT in the array, add it and display it
	if (!in_array($month_created, $month_arr)) {
		array_push($month_arr, $month_created);
		echo "<h2 class='month-container-header'>{$month_created}</h2>
                <div class='month-container'>";
	}
	?>
            <div id="album-container-bottom">
            
                    <div class="album" onclick="openModal('<?= $path_raw ?>')" style='background-image: url("<?= BASE .
	"/public/images/uploaded/" .
	$path[0] ?>")';>
                        <p id="album-title"> <?= htmlspecialchars(
                        	$title
                        ) ?> </p>
                        <div class="album-bottom">
<div class="tags-container">
<?php 
						if (count($tags) === 1 && $tags[0] == null) { ?> 
                            <p class="inside-album-tags">No tag</p>
                        <?php } 
							else if (count($tags) === 1 && $tags[0] !== null){
								for ($l = 0; $l < 1; $l++) { 
								?>
								<div class="inside-album-tags-div">
									<p class="inside-album-tags"><?= htmlspecialchars($tags[$l]) ?></p>
								</div>
								<?php }}
						
						else {
							// foreach ($tags as $tag) { 
							for ($l = 0; $l < 2; $l++) { 
							?>
                                <div class="inside-album-tags-div">
                                    <p class="inside-album-tags"><?= htmlspecialchars($tags[$l]) ?></p>
                                </div>
                                <?php }
							} ?>
							</div>
                        <p class="inside-album-dates"><?= $newDate ?></p>
                    </div>
                </div> 
            </div>
	<?php if ($i + 1 < count($res)) {
 	$date_created_next = $res[$i + 1]["date_created"];
 	$month_created_next = date("F Y", strtotime($date_created_next));
 	if ($month_created_next !== $month_created) {
 		echo "</div>";
 	}
 } else {
 	echo "</div>";
 }
}
?>

	</section>
</div>
<div class="overlay display-none" onclick="closeModal()"></div>
<div class="modal-container display-none">
    <div class="modal display-none"></div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>
