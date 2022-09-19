<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');

function signUp($data, $type){
  $userManager = new UserManager();
  $check = $userManager->createUser($data, $type);
  if ($check === false){
    require(ROOT . '/view/timelineView.php');
  } else {
    $error = $check;
    require(ROOT . '/view/signupView.php');
  }
}

function login($data, $type){
  $userManager = new UserManager();
  $check = $userManager->confirmUser($data, $type);
  if ($check === false){
    require(ROOT . '/view/timelineView.php');
  } else {
    $error = $check;
    require(ROOT . '/view/loginView.php');
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

function goToLink($page){
  switch ($page){
    case "toLanding":
      require(ROOT . '/view/JourneyView.php');
      break;
    case "toAbout":
      require(ROOT . '/view/aboutView.php');
      break;
    case "toTimeline":
      require(ROOT . '/view/timelineView.php');
      break;
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
      require(ROOT . '/view/templateView.php');
      break;
    default:
      break;
  }
}

function viewEntry($entryId){
    $entryManager = new EntryManager();
    $entryContent = $entryManager->getEntry($entryId);
    require(ROOT . '/view/viewEntryView.php');
}
