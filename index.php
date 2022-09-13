<?php
require('./controller/controller.php');

try {
  $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

  switch ($action){
    case "signup" :
    signUp($_REQUEST);
    break;
  }

} catch (Exception $e) {
  $errorMessage = $e->getMessage();
  require("view/errorView.php");
}