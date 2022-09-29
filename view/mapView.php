<?php $title = "Map View"; ?>
<?php $style = "map"; ?>
<?php
// $script = "map";
?>
<?php
$data = json_encode($entries);
$script = "googleMaps";
?>

<?php ob_start(); ?>
<?= "<script> let data = $data </script>" ?>
<?php include "sidebarView.php"; ?>

<!--The div element for the map -->
<div id="map-view-container">
    <h2 class="page-header-text">MAP VIEW</h2>
    <div id="map-view-map"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $_SERVER["GMAP_API_KEY"] ?>&callback=initMap&v=weekly" defer></script>
<!-- <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?= $_SERVER["KMAP_API_KEY"] ?>&libraries=services,clusterer,drawing"></script> -->

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>