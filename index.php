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
			toTimeline($_REQUEST);
			break;

		case "toCalendar":
			toCalendar();
			break;

		case "toCreateEntry":
			createNewEntry();
			break;

		case "toAlbum":
			toAlbum($_SESSION["uid"]);
			break;

		case "toMap":
			toMap($_SESSION["uid"], "all");
			break;

		case "toCreateEntry":
			createNewEntry();
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
		//------------------REGULAR USER--------------------
		//--------------------------------------------------

		// REGULAR SIGNUP
		case "regularSignUp":
			if (isset($_REQUEST)) {
				regularSignUp($_REQUEST);
			} else {
				throw new Exception("Invalid sign-up attempt");
			}
			break;

		// TODO: separate regular & kakao sign-ups
		case "signUp":
			// echoPre($_REQUEST);
			if (isset($_REQUEST["method"])) {
				signUP($_REQUEST, $_REQUEST["method"]);
			} else {
				throw new Exception("Invalid signup attempt");
			}
			break;

		//--------------------------------------------------
		//-------------------GOOGLE USER--------------------
		//--------------------------------------------------

		case "login":
			if (isset($_REQUEST["method"])) {
				login($_REQUEST, $_REQUEST["method"]);
			} else {
				throw new Exception("Invalid login attempt");
			}
			break;

		// TODO: for the time being, until there's a way to differentiate g-id_onload for each button
		case "googleAccount":
			// echoPre($_REQUEST);
			if (isset($_REQUEST["credential"]) and isset($_REQUEST["g_csrf_token"])) {
				$credentials = json_decode(
					base64_decode(
						str_replace(
							"_",
							"/",
							str_replace("-", "+", explode(".", $_REQUEST["credential"])[1])
						)
					),
					true
				);
				// echoPre($credentials);
				if (
					isset($credentials["iss"]) and
					$credentials["iss"] == "https://accounts.google.com" and
					$credentials["aud"] == $credentials["azp"]
				) {
					googleAccount($$credentials);
				} else {
					throw new Exception("Invalid login attempt");
				}
			} else {
				throw new Exception("Invalid login attempt");
			}
			break;

		//--------------------------------------------------
		//-------------------KAKAO USER---------------------
		//--------------------------------------------------

		// isset($_REQUEST["id"]);
		// isset($_REQUEST["kakao_account"]);
		// $_REQUEST["is_email_valid"] == true
		// $_REQUEST["is_email_verified"] == true
		// KAKAO SIGNUP
		case "kakaoSignUp":
			// if (isset)
			kakaoSignUp($_REQUEST);
			break;

		case "kakaoLogin":
			// kakaoLogin();
			break;

		//--------------------------------------------------
		//----------------ENTRY MANAGEMENT------------------
		//--------------------------------------------------

		case "filterEntries":
			if (isset($_REQUEST)) {
				filterEntries($_REQUEST);
			}
			break;
        
        case "deleteEntry":
            deleteEntry($_REQUEST);
            break;

		case "toggleView":
			if (isset($_REQUEST["view"])) {
				if ($_REQUEST["view"] === "week") {
					toTimeline($_SESSION["uid"], "weekly");
				} elseif ($_REQUEST["view"] === "month") {
					toTimeline($_SESSION["uid"], "monthly");
				}
			} else {
				throw new Exception("Error");
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
				throw new Exception("Error: no entry ID");
			}
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
