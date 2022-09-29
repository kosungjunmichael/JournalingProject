<?php

require_once "./model/EntryManager.php";
require_once "./model/UserManager.php";
require_once "./model/TagManager.php";
require_once "./model/FilterManager.php";

//--------------------------------------------------
//----------------PAGE NAVIGATION-------------------
//--------------------------------------------------

function toLanding()
{
	require ROOT . "/view/journeyView.php";
}

function toAboutUs()
{
	require ROOT . "/view/aboutView.php";
}

function toTimeline($u_id, $entry_group)
{
	$entry_manager = new EntryManager();
	$entries = $entry_manager->getEntries($u_id, $entry_group);
	$view = $entry_group;
	
	require ROOT . "/view/timelineView.php";
}

function createNewEntry()
{
	require ROOT . "/view/createEntryView.php";
}

function toMap($u_id, $entry_group)
{
	$entryManager = new EntryManager();
	$entries = $entryManager->getEntries($u_id, $entry_group);
	// echoPre($entries);
	require ROOT . "/view/mapView.php";
}

function toLogout()
{
	session_destroy();
	header("Location: index.php");
}

//--------------------------------------------------
//----------------USER SIGNUP-----------------------
//--------------------------------------------------

function signUp($data, $type)
{
	switch ($type) {
		case "regular":
			$control = [];
			preg_match("/^[a-zA-Z0-9]{4,}/", $data["sign-u"])
				? array_push($control, true)
				: array_push(
					$control,
					"Your username must include at least 4 characters."
				);
			preg_match(
				"/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",
				$data["sign-e"]
			)
				? array_push($control, true)
				: array_push($control, "You must use a proper email address.");
			preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $data["sign-p"])
				? array_push($control, true)
				: array_push(
					$control,
					"Your password did not meet the minimum requirements."
				);
			$data["sign-p"] == $data["sign-cp"]
				? array_push($control, true)
				: array_push($control, "Your passwords did not match.");

			if (count(array_unique($control)) == 1) {
				$userManager = new UserManager();
				$check = $userManager->createUser($data, $type);

				if ($check === false) {
					toTimeline($_SESSION["uid"], "monthly");
				} else {
					$error_signup = $check;
					require ROOT . "/view/journeyView.php";
				}
			} else {
				$error = [];
				foreach ($control as $value) {
					// if ($value != '1') $error .= $value . '<br>';
					if ($value != "1") {
						array_push($error, $value);
					}
				}
				require ROOT . "/view/journeyView.php";
			}
			break;
		default:
			$userManager = new UserManager();
			$check = $userManager->createUser($data, $type);
			if ($check === false) {
				toTimeline($_SESSION["uid"], "monthly");
			} else {
				$error_signup = $check;
				require ROOT . "/view/journeyView.php";
			}
			break;
	}
}

//--------------------------------------------------
//----------------USER LOGIN------------------------
//--------------------------------------------------

function login($data, $type)
{
	$userManager = new UserManager();
	$check = $userManager->confirmUser($data, $type);
	if ($check === false) {
		toTimeline($_SESSION["uid"], "monthly");
	} else {
		$error_login = $check;
		require ROOT . "/view/journeyView.php";
	}
}

//--------------------------------------------------
//----------------ENTRY MANAGEMENT------------------
//--------------------------------------------------

function newEntry($data)
{
	$entryManager = new EntryManager();
	$tagManager = new TagManager();
	if (!empty($data->title) and !empty($data->entry)) {
		$entry_uid = $entryManager->createEntry($data);
		$tagManager->submitTags($data->tags, $entry_uid);
		if ($_FILES["imgUpload"]["error"] !== 4) {
			$checkImgs = $entryManager->uploadImages($entry_uid);
		} elseif (count($_FILES) > 1 and $_FILES["imgUpload"]["error"] === 4) {
			throw new Exception(
				"Error, image error status 4 - controller.php: newEntry()"
			);
		}
		header("Location: index.php?action=toTimeline");
	} else {
		// throw new Exception('Error, entry ID not returned - controller.php: newEntry()');
		$error = "Not a valid Entry";
		require ROOT . "/view/createEntryView.php";
	}
}

function filterEntries($filter)
{
	$entryManager = new EntryManager();
	$filterManager = new FilterManager();
	// $type = "monthly";
	if ($filter === "") {
		$entries = $entryManager->getEntries($_SESSION["uid"], "monthly");
	} else {
		$entries = $filterManager->filterEntriesByTag($_SESSION["uid"], $filter);
		// echoPre($entries);
	}
	require ROOT . "/view/timelineFiltered.php";
}

function viewEntry($entryId)
{
	$entryManager = new EntryManager();
	$entryContent = $entryManager->getEntry($entryId, $_SESSION["uid"]);
	require ROOT . "/view/viewEntryView.php";
}

//--------------------------------------------------
//----------------UTILITY FUNCTIONS-----------------
//--------------------------------------------------

function displayMonths($numOfMonths = 5)
{
	$months = [];
	array_push($months, date("F Y"));
	for ($i = 1; $i < $numOfMonths; $i++) {
		array_push($months, Date("F Y", strtotime("-$i month")));
	}
	return $months;
}

function displayDaysInWeek()
{
	$week = [
		"Monday",
		"Tuesday",
		"Wednesday",
		"Thursday",
		"Friday",
		"Saturday",
		"Sunday",
	];
	return $week;
}

function updateLastActive($uid)
{
	$userManager = new UserManager();
	$userManager->updateLastActive($uid);
}

function echoPre($user_fetch)
{
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
