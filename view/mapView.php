<?php $title = "Map View"; ?>
<?php $style = "map"; ?>
<?php
// $script = "map";
?>
<?php
$script = "googleMaps";
?>

<?php ob_start(); ?>

<?php include "sidebarView.php"; ?>

<!--The div element for the map -->
<div id="map-view-container">
    <h2 class="page-header-text">MAP VIEW</h2>
    <div id="map-view-map"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2OkvUjQsJ15zNioYLSzbjT_i9k6J58c&callback=initMap&v=weekly" defer></script>
<!-- <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=29753c396554755b473a6782fd78b38a&libraries=services,clusterer,drawing"></script> -->

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>