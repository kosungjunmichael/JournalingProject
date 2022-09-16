<?php
require('./controller/controller.php');

session_start();

if (isset($_SESSION['uid'])){
    updateLastActive($_SESSION['uid']);
}

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
        case "entries":
            // creating entries
            if (!empty($_REQUEST['title']) AND !empty($_REQUEST['entry'])){
                $entryContent = (object)array();
                $entryContent->title = $_REQUEST['title'];
                $entryContent->entry = $_REQUEST['entry'];
                $entryContent->userID = $_REQUEST['usr'];
                newEntry($entryContent);
            } else {
                // header("Location: ./view/entryView.php?usr=".$_REQUEST['usr']);
                newEntryFailed();
            }
            break;
        case "timeline":
            require("./view/timelineView.php"); // move to controller
            break;
        default:
            // show login as default
            if (isset($_SESSION['usr'])){
                header('Location: ./view/timelineView.php');
            } else {
                header('Location: ./view/loginView.php');
            }
            break;
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require("view/errorView.php");

}