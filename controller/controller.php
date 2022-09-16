<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');

function signUp($data, $type){
  $userManager = new UserManager();
  $userManager->createUser($data, $type);
}

function login($data, $type){
  $userManager = new UserManager();
  $check = $userManager->confirmUser($data, $type);
  switch ($check){
    case 1:
      // user does not exist
      header ('location: ./view/loginView.php?error=1');
      break;
    case 2:
      // password was incorrect
      header ('location: ./view/loginView.php?error=2');
      break;
    case 3:
      // user is not active
      header ('location: ./view/loginView.php?error=3');
      break;
    default:
      // head to the user's timeline
      header ('location: ./view/timelineView.php?type=registered');
      break;
  }
}

function updateLastActive($uid){
  $userManager = new UserManager();
  $userManager->updateLastActive($uid);
}

function newEntry($data){
  $entryManager = new EntryManager();
  $entryManager->createEntry($data);
}

function newEntryFailed(){
  $entryManager = new EntryManager();
  $entryManager->newEntryFailed();
}
