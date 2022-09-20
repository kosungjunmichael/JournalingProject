<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');

function signUp($data, $type){
  $userManager = new UserManager();
  $check = $userManager->createUser($data, $type);
  if ($check === false){
    toTimeline($_SESSION['uid']);
  } else {
    $error = $check;
    require(ROOT . '/view/signupView.php');
  }
}

function login($data, $type){
  $userManager = new UserManager();
  $check = $userManager->confirmUser($data, $type);
  if ($check === false){
    toTimeline($_SESSION['uid']);
  } else {
    $error = $check;
    require(ROOT . '/view/loginView.php');
  }
}

function updateLastActive($uid){
  $userManager = new UserManager();
  $userManager->updateLastActive($uid);
}

function createNewEntry(){
  require(ROOT . '/view/createEntryView.php');
}

function newEntry($data){
  $entryManager = new EntryManager();
  $check = $entryManager->createEntry($data);
  if ($check){
    $error = "Entry Submitted!";
    toTimeline($check);
  } else {
    $error = "Not a valid Entry";
    require(ROOT . '/view/createEntryView.php');
  }
}

function toTimeline($Unique_id){
$entryManager = new EntryManager();
$entries = $entryManager->getEntries($Unique_id);
require(ROOT . '/view/timelineView.php');
}

function toSignup(){
  require(ROOT . '/view/signupView.php');
}

function toLogin(){
  require(ROOT . '/view/loginView.php');
}

function toLanding(){
  require(ROOT . '/view/journeyView.php');
}

function viewEntry($entryId){
    $entryManager = new EntryManager();
    $entryContent = $entryManager->getEntries($entryId);
    require(ROOT . '/view/viewEntryView.php');
}
