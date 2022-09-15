<?php

session_start();
function dbConnect(){
    return new PDO('mysql:host=localhost;dbname=journal_project;charset=utf8', 'root', '');
}

// if user session exists, update last_active in database table users
if (isset($_SESSION['user'])){
    $db = dbConnect();
    $user = $_SESSION['user'];
    $update = $db->prepare("UPDATE users SET last_active = NOW() WHERE email = :email OR username = :username");
    $update->execute(array(
        'email' => $user,
        'username' => $user
        )
    );
}

require('./controller/controller.php');

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
        case "timeline":
            require("./view/timelineView.php");
            break;
        default:
            // show login as default
            if (isset($_SESSION['user'])){
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