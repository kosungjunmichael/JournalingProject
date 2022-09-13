<!-- this is the controller -->
<?php

// require_once('model/EntryManager.php');
// require_once('model/UserManager.php');
require_once('./model/SignupManager.php');

function signUp($data){
  $userManager = new SignupManager();
  $userManager->createUser($data);

}