<?php $title = "Map View"; ?>
<?php $style = "map"; ?>
<?php $script = "googleMaps"; ?>

<?php ob_start(); ?>
<?php include "sidebarView.php"; ?>

<!--The div element for the map -->
<div id="map-view-container">
    <h2 class="page-header-text">MAP VIEW</h2>
    <div id="map-view-map"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2OkvUjQsJ15zNioYLSzbjT_i9k6J58c&callback=initMap&v=weekly" defer></script>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>
