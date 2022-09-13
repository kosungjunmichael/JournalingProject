<!-- this is the controller -->
<?php

require_once('model/EntryManager.php');
require_once('model/UserManager.php');

function signUp(){
  $userManager = new SignupManager();
  $users = 
  $userManager->signupFunction();
  
}