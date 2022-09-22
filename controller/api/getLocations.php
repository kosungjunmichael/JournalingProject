<?php
// API endpoint to get entry locations
session_start();
// set uid from session variable
if (isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];

    // get data from db
    require_once('../../model/EntryManager.php');
    $entryManager = new EntryManager();
    $entries = $entryManager->getEntries($uid, 'all');

//    $locations = array();

//    foreach ($entries as $entry) {
//        $locations[] = array(
//            'u_id' => $entry['u_id'],
//            'location' => $entry['location']
//        );
//    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($entries);
}
