<?php

require("./controller/controller.php");

try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    // different pages/actions for each $action param
    switch ($action) {
        case "signup":
            // something
            break;
        default:
            displayArticles();
        break;
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
    require("./view/errorView.php");
}