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
    
    // start session
    // check if the session exists
    // for Session => username
    // update the last active column in users db

    switch ($action){
        case "signup":
            // google signup
            if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'google') {
                $response = $_REQUEST['credential'];
                $type = $_REQUEST['type'];
                $credentials = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $response)[1]))));
                signUp($credentials, $type);
            }
            // regular signup
            else if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'regular'){
                $type = $_REQUEST['type'];
                signUp($_REQUEST, $type);
            }
            break;
        case "login":
            // google login
            if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'google') {
                $response = $_REQUEST['credential'];
                $type = $_REQUEST['type'];
                $credentials = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $response)[1]))));
                login($credentials, $type);
            }
            // regular login
            else if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'regular'){
                $type = $_REQUEST['type'];
                login($_REQUEST, $type);
            }
            break;
            // to the entries
        case "timeline":
            require("./view/timelineView.php");
            break;
        default:
            if (isset($_SESSION['user'])){
                $db = dbConnect();
                $user = $_SESSION['user'];
                $update = $db->prepare("UPDATE users SET last_active = NOW() WHERE email = :email OR username = :username");
                $update->execute(array(
                    'email' => $user,
                    'username' => $user
                    )
                );
                header ('location: ./index.php?action=timeline&type=registered');
            }
            header ('location: ./view/loginView.php');

            // show login as default
            break;
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require("view/errorView.php");
}