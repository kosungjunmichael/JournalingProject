<?php $title = "Map View";?>
<?php $style = "map"; ?>
<?php $script = "map";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

    <div id="map-view-container">
        <h2 class="page-header-text">MAP VIEW</h2>
        <div id="map"></div>
    </div>

    <!-- Kakao Maps script -->
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=29753c396554755b473a6782fd78b38a&libraries=services,clusterer,drawing"></script>
<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
