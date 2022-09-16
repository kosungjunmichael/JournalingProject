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
      $error = "user doesn't exist";
      require(ROOT . '/view/loginView.php');
      break;
    case 2:
      $error = "password was incorrect";
      require(ROOT . '/view/loginView.php');
      break;
    case 3:
      $error = "user is not active";
      require(ROOT . '/view/loginView.php');
      break;
    default:
      // head to the user's timeline
      require(ROOT . '/view/timelineView.php');
      break;
  }
}

function updateLastActive($uid){
  $userManager = new UserManager();
  $userManager->updateLastActive($uid);
}

function newEntry($data){
  $entryManager = new EntryManager();
  if ($entryManager->createEntry($data)){
    require(ROOT . '/view/timelineView.php');
  };
}

function newEntryFailed(){
  $error = "Not a valid entry";
  require(ROOT . '/view/createEntryView.php');
}

function viewEntry($entryId){
  require(ROOT . '/view/viewEntryView.php?id=' . $entryId);
}

function showLoginView() {
  require(ROOT . '/view/loginView.php');
}
function showTimelineView() {
  require(ROOT . '/view/timelineView.php');
}

function goToLink($page){
  switch ($page){
    case "createEntry":
      require(ROOT . '/view/createEntryView.php');
      break;
    case "toSignUp":
      require(ROOT . '/view/signupView.php');
      break;
    case "toLogin":
      require(ROOT . '/view/loginView.php');
      break;
    case "toTemplate":
      require(ROOT . '/view/TemplateView.php');
      break;
    default:
    break;
  }
}
