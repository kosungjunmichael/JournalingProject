<?php

require("./controller/controller.php");


try {
  $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
  switch($action){
      case "":
          break;
      case "":
          if(isset($_REQUEST[''])){
              
          }else{
              throw new Exception("Article not found");
          }
          break;
      default :
      
          break;
  }
} catch (Exception $e) { //if we catch an exception
    $errorMessage = $e->getMessage();
    require("view/errorView.php");
}