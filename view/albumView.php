<?php $title = "Album";?>
<?php $style = "album";?>
<?php $script = "script";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<h1>Album</h1>
<section>

<?php 
try
{
    $db = new PDO('mysql:host=localhost;dbname=journal_project;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}

$req = $db->prepare("SELECT x.u_id, x.title, x.date_created,
GROUP_CONCAT(y.path SEPARATOR ', ')
FROM ENTRIES x
JOIN ENTRY_IMAGES y ON y.entry_uid = x.u_id
GROUP BY x.u_id ");

$req -> execute();
$res = $req -> fetchAll(PDO::FETCH_ASSOC);

// implode('', $path);

print_r($res);

for($i = 0; $i <= count($res); $i++){

    // $title = $res[$i]["title"];
    // $path = $res[$i]["GROUP_CONCAT(y.path SEPARATOR ', ')"];
    // $date_created = $res[$i]["date_created"];

    // echo $title;
    // echo $date_created;
    // echo implode(',', $path);
}
?>

</section>
<!-- <div id="album-container">
    <div class="pic-place">
        <img src="https://source.unsplash.com/1600x900/?people" alt="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
    <div class="pic-place">
        <img src="">
    </div>
</div> -->

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
