<?php
require('./controller/controller.php');

// use in PHP
define('ROOT', dirname(__FILE__));

// use in HTML
$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
define('BASE', $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/sites/JournalingProject');

session_start();

if (isset($_SESSION['uid'])){
    updateLastActive($_SESSION['uid']);
}

// for the weekly / monthly toggle
$counter = 1;

try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action){
        case "signup":
            // google signup
            if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'google') {
                $response = $_REQUEST['credential'];
                $type = $_REQUEST['type'];
                $credentials = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $response)[1]))));
                signUp($credentials, 'google');
            }
            // regular signup
            else if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'regular'){
                $type = $_REQUEST['type'];
                signUp($_REQUEST, 'regular');
            }
            break;
        case "login":
            // google login
            if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'google') {
                $response = $_REQUEST['credential'];
                $type = $_REQUEST['type'];
                $credentials = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $response)[1]))));
                login($credentials, 'google');
            }
            // regular login
            else if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'regular'){
                $type = $_REQUEST['type'];
                login($_REQUEST, 'regular');
            }
            break;
            // to the entries
        case "toSignup":
            toSignup();
            break;

        case "toLogin":
            toLogin();
            break;

        case "toggleView":
            $counter++;
            if ($_GET['view'] === "week"){
                toTimeline($_SESSION['uid'], "weekly");
            } else if ($_GET['view'] === "month") {
                toTimeline($_SESSION['uid'], "monthly");
            }
            break;

        case "toTimeline":
            toTimeline($_SESSION['uid'], "monthly");
            break;

        case "toMap":
            toMap($_SESSION['uid']);
            break;

        case "toLanding":
            toLanding();
            break;

        case "createEntry":
            createNewEntry();
            break;
        
        case "tolanding":
            toLanding();
            break;

        case "addNewEntry":
            // TODO: uncomment this
            $entryContent = (object)array();
            $entryContent->title = $_REQUEST['title'];
            $entryContent->entry = $_REQUEST['entry'];
            $entryContent->userID = $_SESSION['uid'];
            // print_r($entryContent);
            // newEntry($entryContent);
            // echo "<pre>";
            // print_r($_FILES);
            // echo "</pre>";
            break;

        case "viewEntry":
            if (isset($_REQUEST['id'])) {
                $entryId = $_REQUEST['id'];
                viewEntry($entryId);
            } else {
                throw new Exception('Error, no entry ID');
            }
            break;

        default:
            // show login as default
            if (isset($_SESSION['uid'])){
                toTimeline($_SESSION['uid'], "monthly");
            } else {
                toLogin();
            }
            break;
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require("view/errorView.php");
}
