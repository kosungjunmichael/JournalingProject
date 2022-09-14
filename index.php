<?php
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
               signUp($_REQUEST, $_REQUEST['type']);
           }
            break;
           // regular signin
        case "signin" :
            signIn($_REQUEST, "login");
            break;
            // to the entries
        case "timeline":
            require("./view/timeline.php");
            break;
        default:
            require("./view/login.php");
            // show login as default
            break;
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require("view/errorView.php");
}