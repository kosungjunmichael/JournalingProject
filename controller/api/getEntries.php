<?php
// API endpoint to get entry locations
session_start();
// set uid from session variable
if (isset($_SESSION["uid"])) {
	$uid = $_SESSION["uid"];

	// get entries data from db
	require_once "../../model/EntryManager.php";
	$entryManager = new EntryManager();
	$entries = $entryManager->getEntries($uid, "all");

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode($entries);
}
