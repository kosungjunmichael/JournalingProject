<!-- this is the controller -->
<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');
//require_once('./model/SignupManager.php');

function signUp($data, $type){
  $userManager = new UserManager();
  $userManager->createUser($data, $type);
}

function login($data, $type){
  $userManager = new UserManager();
  $userManager->confirmUser($data, $type);
}

function newEntry($data){
  $entryManager = new EntryManager();
  $entryManager->createEntry($data);
}