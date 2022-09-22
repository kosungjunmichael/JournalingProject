<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');

function signUp($data, $type){
  $userManager = new UserManager();
  $check = $userManager->createUser($data, $type);
  if ($check === false){
    // session_start();
    toTimeline($_SESSION['uid'], "monthly");
  } else {
    $error = $check['error'];
    if (isset($check['username'])) {
        $username = $check['username'];
    };
    require(ROOT . '/view/loginView.php');
  }
}

function login($data, $type){
  $userManager = new UserManager();
  $check = $userManager->confirmUser($data, $type);
  if ($check === false){
    toTimeline($_SESSION['uid'], "monthly");
  } else {
    $error = $check['error'];
    $username = $check['username'];
    require(ROOT . '/view/loginView.php');
  }
}

function displayMonths($numOfMonths = 5){
  $months = array();
  array_push($months,date('F'));
  For ($i=1;$i<$numOfMonths;$i++){
      array_push($months, Date('F', strtotime("-$i month")));
  }
  return $months;
}

function displayDaysInWeek(){
  $week = array(
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday"
  );
  return $week;
}

function toTimeline($Unique_id, $entryGroup){
  $entryManager = new EntryManager();
  $entries = $entryManager->getEntries($Unique_id, $entryGroup);
  $view = $entryGroup;
  require(ROOT . '/view/timelineView.php');
}

function toMap($uid){
    require(ROOT . '/view/mapView.php');
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
    // require(ROOT . '/index.php?action=sidebarTimeline');
    // toTimeline($check);
    header("Location: index.php?action=toTimeline");
  } else {
    $error = "Not a valid Entry";
    require(ROOT . '/view/createEntryView.php');
  }
}

function toLogout(){
  session_destroy();
  header("Location: index.php");
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
    $entryContent = $entryManager->getEntry($entryId, $_SESSION['uid']);
    require(ROOT . '/view/viewEntryView.php');
}
