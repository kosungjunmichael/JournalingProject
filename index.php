<?php
require "./controller/controller.php";

// USE IN PHP
define("ROOT", dirname(__FILE__));

// USE IN HTML
$httpProtocol =
	!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on" ? "http" : "https";
define(
	"BASE",
	$httpProtocol . "://" . $_SERVER["HTTP_HOST"] . "/sites/JournalingProject"
);

session_start();
if (isset($_SESSION["uid"])) {
	updateLastActive($_SESSION["uid"]);
}

try {
	$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : null;

	switch ($action) {
		//--------------------------------------------------
		//----------------PAGE NAVIGATION-------------------
		//--------------------------------------------------

		case "toLanding":
			toLanding();
			break;

		case "toAboutUs":
			toAboutUs();
			break;

		case "toTimeline":
			toTimeline($_SESSION["uid"], "monthly");
			break;

		case "toCalendar":
			toCalendar();
			break;

		case "toCreateEntry":
			createNewEntry();
			break;
		case "toEditEntry":
			editEntry();
			break;


		case "toAlbum":
			toAlbum($_SESSION["uid"]);
			break;

		case "toMap":
			toMap($_SESSION["uid"], "all");
			break;

		//TODO: these all call the same function, route to the separate login types through the UserManager
		// $_REQUEST uses both get and post values so you only need to use the specific get parameter ex. $_REQUEST['TYPE']

		// // GOOGLE SIGNUP
		// case "googleSignUp":
		//     signUp($_REQUEST, 'google');
		//     break;
		case "toLogout":
			toLogout();
			break;

		//--------------------------------------------------
		//----------------USER SIGNUP-----------------------
		//--------------------------------------------------

		// GOOGLE SIGNUP
		case "googleSignUp":
			signUp($_REQUEST, "google");
			break;

		// KAKAO SIGNUP
		case "kakaoSignUp":
			signUp($_REQUEST, "kakao");
			break;

		// REGULAR SIGNUP
		case "regularSignup":
			signUp($_REQUEST, "regular");
			break;

		case "signUp":
			echoPre($_REQUEST);
			// signUP($_REQUEST, $_REQUEST["method"]);
			break;

		//--------------------------------------------------
		//----------------USER LOGIN------------------------
		//--------------------------------------------------

		// GOOGLE LOGIN
		case "googleLogin":
			login($_REQUEST, "google");
			break;

		// KAKAO LOGIN
		case "kakaoLogin":
			login($_REQUEST, "kakao");
			break;

		// REGULAR LOGIN
		case "regularLogin":
			login($_REQUEST, "regular");
			break;

		case "login":
			// echoPre($_REQUEST);
			login($_REQUEST, $_REQUEST["method"]);
			break;

		//--------------------------------------------------
		//----------------Social Account--------------------
		//--------------------------------------------------

		case "googleAccount":
			googleAccount($_REQUEST);
			break;

		case "kakaoAccount":
			echoPre($_REQUEST);
			// kakaoAccount($_REQUEST);

		//--------------------------------------------------
		//----------------ENTRY MANAGEMENT------------------
		//--------------------------------------------------

		case "filterEntries":
			if (isset($_REQUEST)) {
				filterEntries($_REQUEST);
			}
			break;
        
        case "deleteEntry":
            toDeleteEntry($_REQUEST);
            break;

		case "toggleView":
			if ($_GET["view"] === "week") {
				toTimeline($_SESSION["uid"], "weekly");
			} elseif ($_GET["view"] === "month") {
				toTimeline($_SESSION["uid"], "monthly");
			}
			break;

		case "addNewEntry":
			$entryContent = (object) [];
			$entryContent->userUID = $_SESSION["uid"];
			$entryContent->title = $_REQUEST["title"];
			$entryContent->tags = $_REQUEST["tagNames"];
			$entryContent->location = $_REQUEST["location"];
			$entryContent->weather = $_REQUEST["weather"];
			$entryContent->textContent = $_REQUEST["textContent"];
			newEntry($entryContent);
			break;

		case "viewEntry":
			if (isset($_REQUEST["id"])) {
				viewEntry($_REQUEST["id"]);
			} else {
				throw new Exception("Error, no entry ID");
			}
			break;

		case "editOldEntry":
			if(isset($_REQUEST['entryId'])){
				$entryManager = new EntryManager();
				$entryContent = $entryManager->getEntry($_REQUEST['entryId'], $_SESSION["uid"]);
			//TODO: edit entry function will be created
			// $entryContent = (object) [];
			// $entryContent->userUID = $_SESSION["uid"];
			// $entryContent->title = $_REQUEST["title"];
			// $entryContent->tags = $_REQUEST["tagNames"];
			// $entryContent->location = $_REQUEST["location"];
			// $entryContent->weather = $_REQUEST["weather"];
			// $entryContent->textContent = $_REQUEST["textContent"];
				updateEntry($entryContent, $_REQUEST['entryId']);
			} else throw new Exception("Error, no entry ID");
			break;

		default:
			// SHOW LOGIN AS DEFAULT
			if (isset($_SESSION["uid"])) {
				toTimeline($_SESSION["uid"], "monthly");
			} else {
				toLanding();
			}
			break;
	}
} catch (Exception $e) {
	$errorMessage = $e->getMessage();
	require "view/errorView.php";
}
