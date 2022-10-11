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

 function toTimeline($alertText, $entryGroup)
 {
 	$entry_manager = new EntryManager();
 	$user_manager = new UserManager();
 	if (isset($alertText["alert"])) {
 		switch ($alertText["alert"]) {
 			case "newEntry":
 				$alert = "Entry successfully created";
 				break;
 			case "deleteEntry":
 				$alert = "Entry Successfully deleted";
 				break;
 			case "login":
 				$username = $user_manager->getUsername($_SESSION["uid"])[0];
 				$alert = "Welcome back! $username";
 				break;
 			case "signup":
 				$username = $user_manager->getUsername($_SESSION["uid"])[0];
 				$alert = "Welcome! $username";
 				break;
 			default:
 				break;
 		}
 	}
 	if ($entryGroup === "monthly") {
 		$entries = $entry_manager->getEntries($_SESSION["uid"], "monthly");
 		// echoPre($entries);
 	} elseif ($entryGroup === "weekly") {
 		$entries = $entry_manager->getEntries($_SESSION["uid"], "weekly");
 	}
 	$view = $entryGroup;

 	require ROOT . "/view/timelineView.php";
 }

 function toAlbum($u_id)
 {
 	$entryManager = new EntryManager();
 	$res = $entryManager->getAlbum($u_id);
 	require ROOT . "/view/albumView.php";
 }

 function createNewEntry()
 {
 	require ROOT . "/view/createEntryView.php";
 }

 function editEntry()
 {
 	$entryManager = new EntryManager();
 	$entryContent = $entryManager->getEntry($_REQUEST["id"], $_SESSION["uid"]);
 	require ROOT . "/view/editEntryView.php"; //TODO: EDITENTRYVIEW PAGE SHOULD BE CREATED
 }

 function toCalendar()
 {
 	require ROOT . "/view/calendarView.php";
 }

 function toMap($u_id, $entry_group)
 {
 	$entryManager = new EntryManager();
 	$entries = $entryManager->getEntries($u_id, $entry_group);
 	require ROOT . "/view/mapView.php";
 }

 function toLogout()
 {
 	session_destroy();
 	header("Location: index.php");
 }

 //--------------------------------------------------
 //-------------------GOOGLE USER--------------------
 //--------------------------------------------------

 function googleAccount($data, $type)
 {
 	$userManager = new UserManager();
 	$check = $userManager->createGoogleUser($data, $type);

 	if ($check === false) {
 		// toTimeline($_SESSION["uid"], "monthly");
 		header("Location: index.php?action=toTimeline&alert=login");
 	} else {
 		$error_login = $check;
 		require ROOT . "/view/journeyView.php";
 	}
 }

 //--------------------------------------------------
 //-----------------KAKAO USER-----------------------
 //--------------------------------------------------

 function kakaoSignUp($data, $type)
 {
 	$userManager = new UserManager();
 	$check = $userManager->createKakaoUser($data, $type);

 	if ($check === false) {
 		header("Location: index.php?action=toTimeline&alert=signup");
 	} else {
 		$error_signup = $check;
 		require ROOT . "/view/journeyView.php";
 	}
 }

 function kakaoLogin($data, $type)
 {
 	$userManager = new UserManager();
 	$check = $userManager->confirmUser($data, $type);
 	if ($check === false) {
 		// toTimeline($_SESSION["uid"], "monthly");
 		header("Location: index.php?action=toTimeline&alert=login");
 	} else {
 		$error_login = $check;
 		require ROOT . "/view/journeyView.php";
 	}
 }

 //--------------------------------------------------
 //------------------REGULAR USER--------------------
 //--------------------------------------------------

 function regularSignUp($data, $type)
 {
 	// VALIDATE SIGN-UP FORM
 	$validated = regSignUpValidation($data);

 	if (count(array_unique($validated)) == 1) {
 		$userManager = new UserManager();
 		$check = $userManager->createRegUser($data, $type);

 		if ($check === false) {
 			header("Location: index.php?action=toTimeline&alert=signup");
 		} else {
 			// echoPre($check);
 			$error_signup = $check;
 			require ROOT . "/view/journeyView.php";
 		}
 	} else {
 		$error = array_filter($validated, function ($value) {
 			return $value != "1";
 		});
 		require ROOT . "/view/journeyView.php";
 	}
 }

 function regSignUpValidation($data)
 {
 	$control = [];
 	if (
 		isset($data["sign-u"]) and
 		isset($data["sign-e"]) and
 		isset($data["sign-p"]) and
 		isset($data["sign-cp"])
 	) {
 		$ctrl_u = preg_match("/^[a-zA-Z0-9]{4,}/", $data["sign-u"])
 			? true
 			: "Your username must include at least 4 characters.";
 		$ctrl_e = preg_match(
 			"/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",
 			$data["sign-e"]
 		)
 			? true
 			: "You must use a proper email address.";
 		$ctrl_p = preg_match(
 			"/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/",
 			$data["sign-p"]
 		)
 			? true
 			: "Your password did not meet the minimum requirements.";
 		$ctrl_cp =
 			$data["sign-p"] == $data["sign-cp"]
 				? true
 				: "Your passwords did not match.";

 		array_push($control, $ctrl_u, $ctrl_e, $ctrl_p, $ctrl_cp);
 		return $control;
 	}
 }

 function regularLogin($data, $type)
 {
 	$userManager = new UserManager();
 	$check = $userManager->confirmUser($data, $type);
 	if ($check === false) {
 		header("Location: index.php?action=toTimeline&alert=login");
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
 	if (!empty($data->title) and !empty($data->textContent)) {
 		$entry_uid = $entryManager->createEntry($data);
 		$tagManager->submitTags($data->tags, $entry_uid);
 		entryImageValidation($entryManager, $entry_uid, $_FILES);
 		header("Location: index.php?action=toTimeline&alert=newEntry");
 	} else {
 		$error = "Not a valid Entry";
 		require ROOT . "/view/createEntryView.php";
 	}
 }

 function filterEntries($data)
 {
 	$entryManager = new EntryManager();
 	$filterManager = new FilterManager();
 	// $type = "monthly";
 	if ($data["filter"] === "") {
 		$entries = $entryManager->getEntries(
 			$_SESSION["uid"],
 			strtolower($data["group"])
 		);
 	} else {
 		$entries = $filterManager->filterEntries(
 			$_SESSION["uid"],
 			$data["filter"],
 			$data["value"],
 			$data["group"]
 		);
 	}
 	$group = strtolower($data["group"]);
 	require ROOT . "/view/timelineFiltered.php";
 }

 function deleteEntry($data)
 {
 	$entryManager = new EntryManager();
 	$alert = $entryManager->deleteEntry($data["entryID"], $_SESSION["uid"]);
 	header("Location: index.php?action=toTimeline&alert=deleteEntry");
 }

 function viewEntry($entryId)
 {
 	$entryManager = new EntryManager();
 	$entryContent = $entryManager->getEntry($entryId, $_SESSION["uid"]);
 	require ROOT . "/view/entryView.php";
 }

 function updateEntry($data, $entryId)
 {
 	$entryManager = new EntryManager();
 	// $tagManager = new TagManager();
 	if (!empty($data->title) and !empty($data->textContent)) {
 		$entry_uid = $entryManager->updateOldEntry($data, $entryId);
 		// $tagManager->submitTags($data->tags, $entry_uid);
 		// if ($_FILES["imgUpload"]["error"] !== 4) {
 		// 	$checkImgs = $entryManager->uploadImages($entry_uid);
 		// } elseif (count($_FILES) > 1 and $_FILES["imgUpload"]["error"] === 4) {
 		// 	throw new Exception(
 		// 		"Error, image error status 4 - controller.php: newEntry()"
 		// 	);
 		// }
 		entryImageValidation($entryManager, $entry_uid, $_FILES);
 		header("Location: index.php?action=toTimeline");
 	} else {
 		// throw new Exception('Error, entry ID not returned - controller.php: newEntry()');
 		$error = "Not a valid Entry";
 		require ROOT . "/view/editEntryView.php";
 	}
 }

 function entryImageValidation($entryManager, $entry_uid, $imageData)
 {
 	if (!empty($imageData)) {
 		foreach ($imageData as $image) {
 			echoPre(count($imageData));
 			if ($image["error"] === UPLOAD_ERR_OK) {
 				echoPre($image);
 				echoPre("OK!");
 				if (getimagesize($image["tmp_name"])) {
 					if (
 						mime_content_type($image["tmp_name"]) == "image/jpg" or
 						mime_content_type($image["tmp_name"]) == "image/jpeg" or
 						mime_content_type($image["tmp_name"]) == "image/png"
 					) {
 						if ($image["size"] <= 5e6) {
 							$checkImgs = $entryManager->uploadImage($image, $entry_uid);
 						} else {
 							throw new Exception("Error: image size is greater than 5MB");
 						}
 					} else {
 						throw new Exception(
 							"Error: image is not of an approved type (.jpg, .jpeg, .png)"
 						);
 					}
 				} else {
 					throw new Exception("Error: file uploaded is not an image");
 				}
 			}
 		}
 	}
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

