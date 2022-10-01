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

	private function uploadImage($file, $entry_id)
	{
		$hash = hash_file("md5", $file["tmp_name"]);
		$first = substr($hash, 0, 2);
		$second = substr($hash, 2, 2);

		$this->create_directory(ROOT . "/public/images/uploaded/$first");
		$this->create_directory(ROOT . "/public/images/uploaded/$first/$second");

		$type = explode("/", $file["type"])[1];
		$filename = substr($hash, 4) . "." . $type;
		$newpath = "./public/images/uploaded/$first/$second/$filename";
		move_uploaded_file($file["tmp_name"], $newpath);

		$db = $this->dbConnect();
		$req = $db->prepare(
			"INSERT INTO entry_images (entry_uid, path) VALUES (:entry_id, :path)"
		);
		$req->bindParam("entry_id", $entry_id, PDO::PARAM_STR);
		$req->bindParam("path", $newpath, PDO::PARAM_STR);
		$req->execute();
	}

	public function uploadImages($entry_id)
	{
		foreach ($_FILES as $file) {
			if ($file["error"] === 0) {
				// return $_FILES;
				$this->uploadImage($file, $entry_id);
			}
		}
	}

	protected function checkUniqueIDExist($uid)
	{
		$db = $this->dbConnect();
		// check if UID already exists
		// fetch matching unique IDs
		$query = $db->prepare('SELECT u_id 
                                FROM entries 
                                WHERE u_id = :u_id');
		$query->bindParam("u_id", $uid, PDO::PARAM_STR);
		$query->execute();
		return $query->fetchAll();
	}

	public function createEntry($data)
	{
		$db = $this->dbConnect();

		// create unique ID, check if it's actually unique
		do {
			$uid = $this->uidCreate();
			$existingUID = $this->checkUniqueIDExist($uid);
		} while (count($existingUID) > 0);

		// Getting lat/long for entry location
		$lat_lng = json_encode($this->createCoord($data->location));

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
		//TODO: Why do we need htmlspecialchars for a prepare query?
		$req->bindParam(
			"inTextContent",
			htmlspecialchars($data->textContent),
			PDO::PARAM_STR
		);
		$req->execute();

		$req2 = $db->query("SELECT u_id FROM entries ORDER BY id DESC LIMIT 1");
		$entry_id = $req2->fetch(PDO::FETCH_OBJ);

		// Direct the user to the timeline
		return $entry_id->u_id;
	}

	public function getEntries($userId, $entryGroup)
	{
		$db = $this->dbConnect();
		// current year
		$thisYear = date("Y");
		// current month
		$thisMonth = date("F");
		// current week number for the year
		$thisWeek = date("W");
		$req = $db->prepare('SELECT
                            e.u_id
                            , e.title
                            , e.location
							, e.lat_lng
                            , e.text_content
                            , e.date_created
                            , e.last_edited
                            , DAYNAME(e.last_edited) as dayname
                            , DAY(e.last_edited) as day
                            , WEEK(e.last_edited) as week
                            , MONTHNAME(e.last_edited) as month
                            , YEAR(e.last_edited) as year
                            , GROUP_CONCAT(t.tag_name) as tags
                            -- add GROUP_CONCAT function here. give it an alias like "as tags" 
        FROM entries e
        LEFT JOIN tag_map tm ON e.u_id = tm.entry_id
        LEFT JOIN tags t ON t.id = tm.tag_id
        WHERE user_uid = :userId
        GROUP BY last_edited DESC');
		$req->execute([
			"userId" => $userId,
		]);
		if ($entryGroup === "all") {
			return $req->fetchAll(PDO::FETCH_ASSOC);
		} else {
			// empty array to store the return content
			$entriesDisplay = [];
			while ($entryContent = $req->fetch(PDO::FETCH_ASSOC)) {
				// if Monthly
				if ($entryGroup === "monthly") {
					// for current year
					//					if ($entryContent["year"] == $thisYear) {
					// check if the keyname exists in the $entriesDisplay
					//						if (array_key_exists($entryContent["month"], $entriesDisplay)) {
					//							// push the entryContent into the key
					//							array_push(
					//								$entriesDisplay[$entryContent["month"]],
					//								$entryContent
					//							);
					//						} else {
					//							// create the array in the key & push the entryContent into the key
					//							$entriesDisplay[$entryContent["month"]] = [];
					//							array_push(
					//								$entriesDisplay[$entryContent["month"]],
					//								$entryContent
					//							);
					//						}
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
					//					}
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
		$req->closeCursor();
	}

	public function getEntry($entryId, $userId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT e.title
        , e.u_id
        , e.text_content
        , e.location
        , e.weather
        , e.last_edited
        , e.date_created
        , DAY(e.last_edited) as day
        , MONTHNAME(e.last_edited) as month
        , YEAR(e.last_edited) as year
        , TIME_FORMAT(e.last_edited, "%h:%i %p") as time
        , GROUP_CONCAT(t.tag_name) as tags
        FROM entries e
        LEFT JOIN tag_map tm ON e.u_id = tm.entry_id
        LEFT JOIN tags t ON t.id = tm.tag_id
        WHERE e.user_uid = :userId 
        AND e.u_id = :entryId 
        AND e.is_active = :active');
		$req->execute([
			"userId" => $userId,
			"entryId" => $entryId,
			"active" => 1,
		]);
		$entryContent = $req->fetch(PDO::FETCH_ASSOC);

		$imagesReq = $db->prepare(
			"SELECT path FROM entry_images WHERE entry_uid = ?"
		);
		$imagesReq->execute([$entryId]);
		$images = $imagesReq->fetchAll(PDO::FETCH_ASSOC);
		$entryContent["images"] = $images;

		return $entryContent;
		$req->closeCursor();
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
									WHERE e.user_uid = :inUserUid
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
	}

	public function entryDisplay($userId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare(
			"SELECT text_content FROM entries WHERE user_uid = :inUid"
		);
		$req->execute([
			"inUid" => $userId,
		]);
		if ($req->rowCount() == 1) {
			$result = $req->fetch(PDO::FETCH_ASSOC);
			$req->closeCursor();
			return htmlspecialchars_decode($result["text_content"]);
		} else {
			echo "failed";
			return 0;
		}
	}
}
