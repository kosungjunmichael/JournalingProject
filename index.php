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
			toTimeline($_REQUEST,"monthly");
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

		case "toLogout":
			toLogout();
			break;

		//--------------------------------------------------
		//-------------------GOOGLE USER--------------------
		//--------------------------------------------------

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
					googleAccount($credentials, "google");
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

		case "kakaoSignUp":
			$data = (array) json_decode($_REQUEST["data"]);
			$kakao_account = (array) $data["kakao_account"];
			if (
				isset($data["id"]) and
				isset($data["kakao_account"]) and
				isset($kakao_account["is_email_valid"]) == 1 and
				isset($kakao_account["is_email_verified"]) == 1
			) {
				kakaoSignUp($kakao_account, "kakao");
			} else {
				throw new Exception("Invalid signup attempt");
			}
			break;

		case "kakaoLogin":
			$data = (array) json_decode($_REQUEST["data"]);
			$kakao_account = (array) $data["kakao_account"];
			if (
				isset($data["id"]) and
				isset($data["kakao_account"]) and
				isset($kakao_account["is_email_valid"]) == 1 and
				isset($kakao_account["is_email_verified"]) == 1
			) {
				kakaoLogin($kakao_account, "kakao");
			} else {
				throw new Exception("Invalid signup attempt");
			}
			break;

		//--------------------------------------------------
		//------------------REGULAR USER--------------------
		//--------------------------------------------------

		case "regularSignUp":
			if (isset($_REQUEST)) {
				regularSignUp($_REQUEST, "regular");
			} else {
				throw new Exception("Invalid sign-up attempt");
			}
			break;

		case "regularLogin":
			if (isset($_REQUEST["login-ue"]) AND isset($_REQUEST["login-p"])) {
				regularLogin($_REQUEST, "regular");
			} else {
				throw new Exception("Invalid login attempt");
			}
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
			if (isset($_REQUEST)) {
				// echoPre($_REQUEST);
				// echoPre($_FILES);
				$entryContent = (object) [];
				$entryContent->userUID = $_SESSION["uid"];
				$entryContent->title = $_REQUEST["title"];
				$entryContent->tags = $_REQUEST["tagNames"];
				$entryContent->location = $_REQUEST["location"];
				$entryContent->weather = $_REQUEST["weather"];
				$entryContent->textContent = $_REQUEST["textContent"];
				newEntry($entryContent);
			}
			break;

		case "viewEntry":
			if (isset($_REQUEST["id"])) {
				viewEntry($_REQUEST["id"]);
			} else {
				throw new Exception("Error: no entry ID");
			}
			break;

		case "editOldEntry":
			if(isset($_REQUEST['entryId'])){
				$entryManager = new EntryManager();

			$entryContent = (object) [];
			$entryContent->userUID = $_SESSION["uid"];
			$entryContent->title = $_REQUEST["title"];
			$entryContent->tags = $_REQUEST["entryTag"];
			$entryContent->location = $_REQUEST["location"];
			$entryContent->weather = $_REQUEST["weather"];
			$entryContent->textContent = $_REQUEST["textContent"];
			// $entryContent->file = $_REQUEST["imgUpload1"];
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
