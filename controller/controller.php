<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');

//--------------------------------------------------
//----------------PAGE NAVIGATION-------------------
//--------------------------------------------------

function toLanding() {
  require(ROOT . '/view/journeyView.php');
}

function toAboutUs() {
  require(ROOT . '/view/aboutView.php');
}

// function toSignup() {
//   require(ROOT . '/view/signupView.php');
// }

// function toLogin() {
//   require(ROOT . '/view/journeyView.php');
// }

function toTimeline($Unique_id, $entryGroup) {
  $entryManager = new EntryManager();
  $entries = $entryManager->getEntries($Unique_id, $entryGroup);
  $view = $entryGroup;
  require(ROOT . '/view/timelineView.php');
}

function createNewEntry() {
  require(ROOT . '/view/createEntryView.php');
}

function toMap($uid) {
  require(ROOT . '/view/mapView.php');
}

function toLogout() {
  session_destroy();
  header("Location: index.php");
}

//--------------------------------------------------
//----------------USER SIGNUP-----------------------
//--------------------------------------------------

function signUp($data, $type){
  // $userManager = new UserManager();
  // $check = $userManager->createUser($data, $type);
  // echoPre($check);
  switch ($type) {
    case 'regular':
      $control = [];
      preg_match("/^[a-zA-Z0-9]{4,}/", $data['sign-u']) ? array_push($control, true) : array_push($control, "Your username must include at least 4 characters.");
      preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $data['sign-e']) ? array_push($control, true) : array_push($control, "You must use a proper email address.");
      preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/", $data['sign-p']) ? array_push($control, true) : array_push($control, "Your password did not meet the minimum requirements.");
      $data['sign-p'] == $data['sign-cp'] ? array_push($control, true) : array_push($control, "Your passwords did not match.");

      if (count(array_unique($control)) == 1) {
        $userManager = new UserManager();
        $check = $userManager->createUser($data, $type);

        if ($check === false) {
          toTimeline($_SESSION['uid'], "monthly");
        } else {
          $error_signup = $check;
          // if (isset($check['error'])) {
          //   $error = $check['error'];
          //   if (isset($check['username'])) {
          //     $username = $check['username'];
          //   };
          //   if (isset($check['email'])) {
          //     $email = $check['email'];
          //   };
          // } else {
          //   $error = $check;
          // }
          require(ROOT . '/view/journeyView.php');
        }
      } else {
        $error = [];
        foreach ($control as $value) {
          // if ($value != '1') $error .= $value . '<br>';
          if ($value != '1') array_push($error, $value);
        }
        require(ROOT . '/view/journeyView.php');
      }
      break;
    default:
      $userManager = new UserManager();
      $check = $userManager->createUser($data, $type);
      if ($check === false) {
        toTimeline($_SESSION['uid'], "monthly");
      } else {
        $error_signup = $check;
        // if (isset($check['error'])) {
        //   $error = $check['error'];
        //   if (isset($check['username'])) {
        //     $username = $check['username'];
        //   };
        //   if (isset($check['email'])) {
        //     $email = $check['email'];
        //   };
        // } else {
        //   $error = $check;
        // }
        require(ROOT . '/view/journeyView.php');
      }
      break;
  }

  // if ($check === false){
  //   toTimeline($_SESSION['uid'], "monthly");
  // } else {
  //   if (isset($check['error'])) {
  //     $error = $check['error'];
  //     if (isset($check['username'])) {
  //         $username = $check['username'];
  //     };
  //     if (isset($check['email'])) {
  //         $email = $check['email'];
  //     };
  //   } else {
  //     $error = $check;
  //   }
  //   require(ROOT . '/view/signUpView.php');
  // }
}

// function kakaoSignUp($data) {
//   echoPre($data);
// }

//--------------------------------------------------
//----------------USER LOGIN------------------------
//--------------------------------------------------

function login($data, $type){
  $userManager = new UserManager();
  $check = $userManager->confirmUser($data, $type);
  // echoPre($check);
  if ($check === false){
    toTimeline($_SESSION['uid'], "monthly");
  } else {
    $error_login = $check;
    // $error = $check['error'];
    require(ROOT . '/view/journeyView.php');
  }
}

//--------------------------------------------------
//----------------ENTRY MANAGEMENT------------------
//--------------------------------------------------

// function newEntry($data){
//   $entryManager = new EntryManager();
//   $entry_id = $entryManager->createEntry($data);
//   if ($entry_id){
//     if ($_FILES['imgUpload']['error'] !== 4) {
//       $checkImgs = $entryManager->uploadImages($entry_id);
//     }
//     $error = "Entry Submitted!";
//     // require(ROOT . '/index.php?action=sidebarTimeline');
//     // toTimeline($check);
//     header("Location: index.php?action=toTimeline");
//   } else {
//     $error = "Not a valid Entry";
//     require(ROOT . '/view/createEntryView.php');
//   }
// }

function newEntry($data) {
  $entryManager = new EntryManager();
  $entry_uid = $entryManager->createEntry($data);
  // echo "controller-newEntry-ENTRY_ID:  ", $entry_uid, "<br>";
  if ($entry_uid){
    if ($_FILES['imgUpload']['error'] !== 4) {
      $checkImgs = $entryManager->uploadImages($entry_uid);
    } else if (count($_FILES) > 1 AND $_FILES['imgUpload']['error'] === 4) {
      throw new Exception('Error, image error status 4 - controller.php: newEntry()');
    }
    $error = "Entry Submitted!";
    // require(ROOT . '/index.php?action=sidebarTimeline');
    // toTimeline($check);
    header("Location: index.php?action=toTimeline");
  } else {
    throw new Exception('Error, entry ID not returned - controller.php: newEntry()');
    $error = "Not a valid Entry";
    require(ROOT . '/view/createEntryView.php');
  }
}

function viewEntry($entryId){
    $entryManager = new EntryManager();
    $entryContent = $entryManager->getEntry($entryId, $_SESSION['uid']);
    // echo "<pre>";
    // print_r($entryContent);
    // echo "</pre>";
    require(ROOT . '/view/viewEntryView.php');
}

//--------------------------------------------------
//----------------UTILITY FUNCTIONS-----------------
//--------------------------------------------------

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


function updateLastActive($uid){
  $userManager = new UserManager();
  $userManager->updateLastActive($uid);
}

function echoPre($user_fetch) {
  if (is_array($user_fetch)) {
    echo "<pre>";
    print_r($user_fetch);
    echo "</pre>";
  } else {
    echo "<pre>";
    echo $user_fetch;
    echo "</pre>";
  }
}