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

try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action){
//--------------------------------------------------
//----------------PAGE NAVIGATION-------------------
//--------------------------------------------------

        // case "toSignup":
        //     toSignup();
        //     break;

        // case "toLogin":
        //     toLogin();
        //     break;

        case "toTimeline":
            toTimeline($_SESSION['uid'], "monthly");
            break;

        case "toMap":
            toMap($_SESSION['uid']);
            break;

        case "toLanding":
            toLanding();
            break;

        case "toAboutUs":
            toAboutUs();
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
            kakaoSignUp($_REQUEST);
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
            
        // REGULAR LOGIN
        case "regularLogin":
            login($_REQUEST, 'regular');
            break;

//--------------------------------------------------
//----------------ENTRY MANAGEMENT------------------
//--------------------------------------------------

        case "toggleView":
            if ($_GET['view'] === "week"){
                toTimeline($_SESSION['uid'], "weekly");
            } else if ($_GET['view'] === "month") {
                toTimeline($_SESSION['uid'], "monthly");
            }
            break;
        
        case "addNewEntry":
            $entryContent = (object)array();
            $entryContent->title = $_REQUEST['title'];
            $entryContent->entry = $_REQUEST['textContent'];
            $entryContent->tags = $_REQUEST['tagNames'];
            $entryContent->userUID = $_SESSION['uid'];
            // print_r($entryContent);
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
            // show login as default
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
