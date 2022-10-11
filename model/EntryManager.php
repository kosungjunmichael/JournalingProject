<?php

require_once "Manager.php";

class EntryManager extends Manager
{
	private function create_directory($path)
	{
		if (file_exists($path)) {
			return true;
		} else {
			return mkdir($path, 0777, true);
		}
	}

	public function uploadImage($file, $entry_id)
	{
		$hash = hash_file("md5", $file["tmp_name"]);
		$first = substr($hash, 0, 2);
		$second = substr($hash, 2, 2);

		$this->create_directory(ROOT . "/public/images/uploaded/$first");
		$this->create_directory(ROOT . "/public/images/uploaded/$first/$second");

		$type = explode("/", $file["type"])[1];
		$filename = substr($hash, 4) . "." . $type;
		$newpath = "$first/$second/$filename";
		move_uploaded_file($file["tmp_name"],"./public/images/uploaded/$first/$second/$filename");

		$db = $this->dbConnect();
		$req = $db->prepare(
			"INSERT INTO entry_images (entry_uid, path) VALUES (:entry_id, :path)"
		);
		$req->bindParam("entry_id", $entry_id, PDO::PARAM_STR);
		$req->bindParam("path", $newpath, PDO::PARAM_STR);
		$req->execute();
	}

	// protected function checkUniqueIDExist($uid)
	// {
	// 	$db = $this->dbConnect();
	// 	// check if UID already exists
	// 	// fetch matching unique IDs
	// 	$query = $db->prepare('SELECT u_id
    //                             FROM entries
    //                             WHERE u_id = :u_id');
	// 	$query->bindParam("u_id", $uid, PDO::PARAM_STR);
	// 	$query->execute();
	// 	return $query->fetchAll();
	// }

	public function createEntry($data)
	{
		$db = $this->dbConnect();

        // Get all unique ID's for entries
        $allUIDs = $this->checkUniqueIDExist("entries");

        // echoPre($allUIDs);
		// create unique ID, check if it's actually unique
        foreach($allUIDs as $existingUID){
            do {
                $uid = $this->uidCreate();
                // $existingUID = $this->checkUniqueIDExist($uid);
            } while ($uid === $existingUID);
        }
        // echoPre($uid);

		// Getting lat/long for entry location
		$lat_lng =
			$data->location === ""
				? '{"lat":"","lng":""}'
				: json_encode($this->createCoord($data->location));

		// Inserting the entry into the 'entries' table
		$req = $db->prepare('INSERT INTO entries
                                (u_id
                                , user_uid
								, title
								, location
								, lat_lng
								, weather
                                ,text_content)
                            VALUES (:inUID
								, :inUser_UID
								, :inTitle
								, :inLocation
								, :inLatLong
								, :inWeather
								, :inTextContent)
            ');
		$req->bindParam("inUID", $uid, PDO::PARAM_STR);
		$req->bindParam("inUser_UID", $data->userUID, PDO::PARAM_STR);
		$req->bindParam("inTitle", $data->title, PDO::PARAM_STR);
		$req->bindParam("inLocation", $data->location, PDO::PARAM_STR);
		$req->bindParam("inLatLong", $lat_lng, PDO::PARAM_STR);
		$req->bindParam("inWeather", $data->weather, PDO::PARAM_INT);

		$req->bindParam("inTextContent", $data->textContent, PDO::PARAM_STR);
		$req->execute();

		$req2 = $db->query("SELECT u_id FROM entries ORDER BY id DESC LIMIT 1");
		$entry_id = $req2->fetch(PDO::FETCH_OBJ);

		// Direct the user to the timeline
		return $entry_id->u_id;
	}
	/////////////////////////////////
	public function updateOldEntry($data, $entryId)
	{
		$db = $this->dbConnect();
		if (isset($data) && !empty($data)) {
			//////////UPDATE THE IMAGE
			if ($_FILES["imgUpload"]) {
				$hash = hash_file("md5", $_FILES["imgUpload"]["tmp_name"]);
				$first = substr($hash, 0, 2);
				$second = substr($hash, 2, 2);

				$this->create_directory(ROOT . "/public/images/uploaded/$first");
				$this->create_directory(
					ROOT . "/public/images/uploaded/$first/$second"
				);

				$type = explode("/", $_FILES["imgUpload"]["type"])[1];
				$filename = substr($hash, 4) . "." . $type;
				$newpath = "$first/$second/$filename";
				// echoPre($newpath);
				move_uploaded_file(
					$_FILES["imgUpload"]["tmp_name"],
					"./public/images/uploaded/$first/$second/$filename"
				);

				$req = $db->prepare(
					"UPDATE entry_images SET path = :inPath WHERE entry_uid = :entryId ORDER BY id DESC LIMIT 1)"
				);
				$req->bindParam("inPath", $newpath, PDO::PARAM_STR);
				$req->bindParam("path", $entryId, PDO::PARAM_STR);
				$req->execute();
			}
			//////////////END OF IMG UPDATE

            if ($data->location === ""){
                $data->location = '{"lat":"","lng":""}';
            } else {
                $lat_lng = json_encode($this->createCoord($data->location));
            }

			// $req = $db->prepare('UPDATE entries e SET e.title = :inTitle
			// , e.text_content = :inText_content
			// , e.location =:inLocation
			// , e.lat_lng = :inLatLong
			// , e.weather = :inWeather
			// , e.last_edited = NOW()
			// WHERE e.user_uid = :userId
			// AND e.u_id = :entryId
			// AND e.is_active = 1');

			///CONTROLLING THE TAG EXISTENCE
			$query = $db->prepare("SELECT id from tags WHERE tag_name = ?");
			$query->execute([$data->tags]);
			if ($query->rowCount() == 0) {
				$query = $db->prepare("INSERT INTO tags (tag_name) VALUES (?)");
				$query->execute([$data->tags]);
			}

			$req = $db->prepare('UPDATE entries e, tag_map tm, entry_images i SET e.title= :inTitle
				, e.text_content = :inText_content
				, e.location =:inLocation
				, e.lat_lng = :inLatLong
				, e.weather =:inWeather
				, e.last_edited = NOW()
				, tm.tag_id = (SELECT id from tags WHERE tag_name = :inTag)			
				WHERE e.user_uid = :userId
				AND  e.u_id = :entryId  
				AND e.is_active = 1 
				AND tm.entry_id = e.u_id 
				AND i.entry_uid=e.u_id');

			$req->execute([
				"inTitle" => $data->title,
				"inText_content" => $data->textContent,
				"inLocation" => $data->location,
				"inLatLong" => $lat_lng,
				"inWeather" => $data->weather,
				"inTag" => $data->tags,
				"userId" => $data->userUID,
				"entryId" => $entryId,
			]);

			if ($req->rowCount() == 1) {
				echo "<script>alert('Your entry has been updated successfully');</script>";
				$req->closeCursor();
				return $data->userUID;
			}
		} else {
			echo "<script>alert('Missing information. Entry update process is aborting...')</script>";
			return $data->entryId;
		}
	}

	////////////////////////////////

	public function getEntries($userId, $entryGroup)
	{
		$db = $this->dbConnect();
		// current year
		$thisYear = date("Y");
		// current month
		$thisMonth = date("F");
		// current week number for the year
		$thisWeek = date("W");

		if ($entryGroup === "all") {
			return $this->getEnt("allEntries", $userId);
		} else {
			// empty array to store the return content
			$entriesDisplay = [];
			// All Entries
			$entryContents = $this->getEnt("allEntries", $userId);
			foreach ($entryContents as $entryContent) {
				// if Monthly
				if ($entryGroup === "monthly") {
					$monthYearKey = $entryContent["month"] . " " . $entryContent["year"];
					// check if the keyname exists in the $entriesDisplay
					if (array_key_exists($monthYearKey, $entriesDisplay)) {
						// push the entryContent into the key
						array_push($entriesDisplay[$monthYearKey], $entryContent);
					} else {
						// create the key in the array & push the entryContent into the key
						$entriesDisplay[$monthYearKey] = [];
						$entriesDisplay[$monthYearKey][] = $entryContent;
					}
				} elseif ($entryGroup === "weekly") {
					// for current year & month & weeknumber
					if (
						$entryContent["year"] == $thisYear and
						$entryContent["month"] == $thisMonth and
						$entryContent["week"] == $thisWeek
					) {
						// check if the keyname exists in the $entriesDisplay
						if (array_key_exists($entryContent["dayname"], $entriesDisplay)) {
							// push the entryContent into the key
							array_push(
								$entriesDisplay[$entryContent["dayname"]],
								$entryContent
							);
						} else {
							// create the array in the key & push the entryContent into the key
							$entriesDisplay[$entryContent["dayname"]] = [];
							array_push(
								$entriesDisplay[$entryContent["dayname"]],
								$entryContent
							);
						}
					}
				}
			}
			return $entriesDisplay;
		}
	}

	public function getEntry($entryId, $userId)
	{
		$db = $this->dbConnect();

		// Single Entry
		$entryContent = $this->getEnt("singleEntry", $userId, $entryId);

		$imagesReq = $db->prepare(
			"SELECT path FROM entry_images WHERE entry_uid = ?"
		);
		$imagesReq->execute([$entryId]);
		$images = $imagesReq->fetchAll(PDO::FETCH_ASSOC);
		$entryContent["images"] = $images;

		return $entryContent;
		$imagesReq->closeCursor();
	}

	public function deleteEntry($entryUId, $userUID)
	{
		$db = $this->dbConnect();

		$req = $db->prepare(
			"UPDATE entries SET is_active = 0 WHERE u_id = ? AND user_uid = ?"
		);
		$req->bindParam(1, $entryUId, PDO::PARAM_STR);
		$req->bindParam(2, $userUID, PDO::PARAM_STR);
		$req->execute();

		return "Entry successfully deleted";
	}

	// public function getImages($uid){

	//     $db = $this->dbConnect();
	//     // check if UID already exists
	//     // fetch matching unique IDs
	//     $query = $db->prepare('SELECT u_id from entries WHERE u_id = :u_id ORDER BY date_created DESC');
	//     $query->bindParam('u_id', $uid, PDO::PARAM_STR);
	//     $query->execute();
	//     return $query->fetchAll();
	// }

	public function getAlbum($u_id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.u_id,
									e.title,
									e.date_created,
									GROUP_CONCAT(DISTINCT i.path) as paths,
									GROUP_CONCAT(DISTINCT t.tag_name) as tags
									FROM entries e
									LEFT JOIN tag_map tm ON tm.entry_id = e.u_id
									LEFT JOIN tags t ON t.id = tm.tag_id
									INNER JOIN entry_images i ON i.entry_uid = e.u_id
									WHERE e.user_uid = :inUserUid AND e.is_active = 1
									GROUP BY e.u_id ORDER BY e.date_created DESC');

		$req->execute([
			"inUserUid" => $u_id,
		]);
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function createCoord($location)
	{
		$location = urlencode($location);
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$location}&key={$_SERVER["GMAP_API_KEY"]}";
        if(file_get_contents($url)){
            $resp = json_decode(file_get_contents($url), true);
            $lat = isset($resp["results"][0]["geometry"]["location"]["lat"])
                ? $resp["results"][0]["geometry"]["location"]["lat"]
                : "";
            $lng = isset($resp["results"][0]["geometry"]["location"]["lng"])
                ? $resp["results"][0]["geometry"]["location"]["lng"]
                : "";
    
            return [
                "lat" => $lat,
                "lng" => $lng,
            ];
        };
	}

	public function entryDisplay($userId)
	{
		$db = $this->dbConnect();
		$defaultAllowedTags = [
			"p",
			"h1",
			"h2",
			"h3",
			"h4",
			"h5",
			"h6",
			"blockquote",
			"q",
			"strong",
			"em",
			"ul",
			"ol",
			"li",
			"font",
			"style",
			"b",
			"i",
			"u",
			"div",
			"span",
		];
		$req = $db->prepare(
			"SELECT text_content FROM entries WHERE user_uid = :inUid"
		);
		$req->execute([
			"inUid" => $userId,
		]);
		if ($req->rowCount() == 1) {
			$result = $req->fetch(PDO::FETCH_ASSOC);
			$req->closeCursor();
			return strip_tags($result["text_content"], $defaultAllowedTags);
		} else {
			echo "failed";
			return 0;
		}
	}
}
