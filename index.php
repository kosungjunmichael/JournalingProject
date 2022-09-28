<?php
require('./controller/controller.php');

// USE IN PHP
define('ROOT', dirname(__FILE__));

// USE IN HTML
$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
define('BASE', $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/sites/JournalingProject');

session_start();
if (isset($_SESSION['uid'])){
    updateLastActive($_SESSION['uid']);
}
// TODO: REMOVE THIS
// echo "SESSION: ", $_SESSION['uid'];
try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action){
//--------------------------------------------------
//----------------PAGE NAVIGATION-------------------
//--------------------------------------------------

        case "toLanding":
            toLanding();
            break;
            
        case "toAboutUs":
            toAboutUs();
            break;

        case "toTimeline":
            toTimeline($_SESSION['uid'], "monthly");
            break;

        case "toAlbum":
            toAlbum($_SESSION['uid']);
            break;

        case "toMap":
            toMap($_SESSION['uid']);
            break;

        case "createEntry":
            createNewEntry();
            break;

        case "toLogout":
            toLogout();
            break;

//--------------------------------------------------
//----------------USER SIGNUP-----------------------
//--------------------------------------------------

        // GOOGLE SIGNUP
        case "googleSignUp":
            signUp($_REQUEST, 'google');
            break;

        // KAKAO SIGNUP
        case "kakaoSignUp":
            signUp($_REQUEST, 'kakao');
            break;

        // REGULAR SIGNUP
        case "regularSignup":
            signUp($_REQUEST, 'regular');
            break;

//--------------------------------------------------
//----------------USER LOGIN------------------------
//--------------------------------------------------

        // GOOGLE LOGIN
        case "googleLogin":
            login($_REQUEST, 'google');
            break;

        // KAKAO LOGIN
        case "kakaoLogin":
            login($_REQUEST, 'kakao');
            break;
            
        // REGULAR LOGIN
        case "regularLogin":
            login($_REQUEST, 'regular');
            break;

//--------------------------------------------------
//----------------ENTRY MANAGEMENT------------------
//--------------------------------------------------
        case "filterEntries":
            if (isset($_REQUEST['filter'])){
                filterEntries($_REQUEST['filter']);
            }
            break;

        case "toggleView":
            if ($_GET['view'] === "week"){
                toTimeline($_SESSION['uid'], "weekly");
            } else if ($_GET['view'] === "month") {
                toTimeline($_SESSION['uid'], "monthly");
            }
            break;
        
        case "addNewEntry":
            // echoPre($_REQUEST);
            $entryContent = (object)array();
            $entryContent->userUID = $_SESSION['uid'];
            $entryContent->title = $_REQUEST['title'];
            $entryContent->tags = $_REQUEST['tagNames'];
            $entryContent->location = $_REQUEST['location'];
            $entryContent->weather = $_REQUEST['weather'];
            $entryContent->entry = $_REQUEST['textContent'];
            newEntry($entryContent);
            break;

        case "viewEntry":
            if (isset($_REQUEST['id'])) {
                viewEntry($_REQUEST['id']);
            } else {
                throw new Exception('Error, no entry ID');
            }
            break;
            
        default:
            // SHOW LOGIN AS DEFAULT
            if (isset($_SESSION['uid'])){
                toTimeline($_SESSION['uid'], "monthly");
            } else {
                toLanding();
            }
            break;
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require("view/errorView.php");
}
