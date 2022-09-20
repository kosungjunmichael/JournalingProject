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
        case "linkTo":
            $page = $_REQUEST['page'];
            switch($page){
                case "toLanding":
                    goToLink("toLanding");
                    break;
                case "toAbout":
                    goToLink("toAbout");
                    break;
                case "toTimeline":
                    goToLink("toTimeline");
                    break;
                case "createEntry":
                    goToLink("createEntry");
                    break;
                case "toSignUp":
                    goToLink("toSignUp");
                    break;
                case "toLogin":
                    goToLink("toLogin");
                    break;
                default:
                    break;
            }
        case "entries":
            if (isset($_REQUEST['type'])) {
                $type = $_REQUEST['type'];
                switch ($type) {
                    case "create":
                        if (!empty($_REQUEST['title']) AND !empty($_REQUEST['entry'])){
                            $entryContent = (object)array();
                            $entryContent->title = $_REQUEST['title'];
                            $entryContent->entry = $_REQUEST['entry'];
                            $entryContent->userID = $_REQUEST['usr'];
                            newEntry($entryContent);
                        } else {
                            newEntryFailed();
                        }
                        break;
                    case "view":
                        if (isset($_REQUEST['id'])) {
                            $entryId = $_REQUEST['id'];
                            viewEntry($entryId);
                        } else {
                            throw new Exception('Error, no entry ID');
                        }
                        break;
                    default:
                        // default
                        break;
                }
            } else if (!isset($_REQUEST['type'])) {
                // handle routing error
                // redirect to error page
            }
            break;
        default:
            // show login as default
            if (isset($_SESSION['usr'])){
                goToLink('showlogin');
            } else {
                goToLink('toLogin');
            }
            break;
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require("view/errorView.php");
}


