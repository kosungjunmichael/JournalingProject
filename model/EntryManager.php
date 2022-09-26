<?php

require_once('Manager.php');

class EntryManager extends Manager{

    private function create_directory($path) {
        if(file_exists($path)) {
          return true;
        } else {
          return mkdir($path, 0777, true);
        }
      }

    private function uploadImage($file, $entry_uid) {
        // echo "EntryManager-uploadImage-ENTRY_ID:  ", $entry_uid, "<br>";
        try {
            $hash = hash_file("md5", $file['tmp_name']);
            $first = substr($hash, 0, 2);
            $second = substr($hash, 2, 2);
    
            $this->create_directory("./public/images/uploaded/$first");
            $this->create_directory("./public/images/uploaded/$first/$second");
    
            $type = explode("/",$file['type'])[1];
            $filename = substr($hash, 4) . "." . $type;
            $newpath = "./public/images/uploaded/$first/$second/$filename";
            move_uploaded_file($file['tmp_name'], $newpath);
    
            // TODO: add image path to DB
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO entry_images (entry_uid, path) VALUES (:entry_uid, :path)');
            $req->bindParam('entry_uid', $entry_uid, PDO::PARAM_STR);
            $req->bindParam('path', $newpath, PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            throw new Exception('Error, something went wrong when uploading image - EntryManager.php: uploadImage()');
        }
    }

    public function uploadImages($entry_uid) {
        foreach($_FILES as $file){
            if ($file['error']===0) {
                $this->uploadImage($file, $entry_uid);
            }
        }
    }

    protected function checkUniqueIDExist($uid){
        $db = $this->dbConnect();
        // check if UID already exists
        // fetch matching unique IDs
        $query = $db->prepare('SELECT u_id from entries WHERE u_id = :u_id');
        $query->bindParam('u_id', $uid, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    public function createEntry($data){
        $db = $this->dbConnect();

        if (!empty($data->title) OR !empty($data->entry)){

            // create unique ID, check if it's actually unique
            do {
                $uid = $this->uidCreate();
                $existingUID = $this->checkUniqueIDExist($uid);
            } while (count($existingUID) > 0);

            // Inserting the entry into the 'entries' table
            $req = $db->prepare('INSERT INTO entries (title, text_content, user_uid, u_id) VALUES (:title, :entry, :user_uid, :uid)');
            $req->bindParam('title', $data->title, PDO::PARAM_STR);
            $req->bindParam('entry', $data->entry, PDO::PARAM_STR);
            $req->bindParam('user_uid', $data->userUID, PDO::PARAM_STR);
            $req->bindParam('uid', $uid, PDO::PARAM_STR);
            $req->execute();

            $req2 = $db->query('SELECT u_id FROM entries ORDER BY id DESC LIMIT 1');
            $entry_id = $req2->fetch(PDO::FETCH_OBJ);
    
            // Direct the user to the timeline
            return $entry_id->u_id;
        } else {
            return false;
        }
    }

    public function getEntries($userId, $entryGroup){
        $db = $this->dbConnect();
        // current year
        $thisYear = date('Y');
        // current month
        $thisMonth = date('F');
        // current week number for the year
        $thisWeek = date('W');
        $req = $db->prepare('SELECT
        u_id
        , title
        , text_content
        , last_edited
        , DAYNAME(last_edited) as dayname
        , WEEK(last_edited) as week
        , DAY(last_edited) as day
        , MONTHNAME(last_edited) as month
        , YEAR(last_edited) as year
        , date_created
        , location
        FROM entries WHERE user_uid = :userId GROUP BY last_edited DESC');
        $req->execute(array(
            'userId' => $userId,
        ));
        if ($entryGroup === 'all') {
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // empty array to store the return content
            $entriesDisplay = array();
            while ($entryContent = $req->fetch(PDO::FETCH_ASSOC)) {
                // if Monthly
                if ($entryGroup === "monthly") {
                    // for current year
                    if ($entryContent['year'] == $thisYear) {
                        // check if the keyname exists in the $entriesDisplay
                        if (array_key_exists($entryContent['month'], $entriesDisplay)) {
                            // push the entryContent into the key
                            array_push($entriesDisplay[$entryContent['month']], $entryContent);
                        } else {
                            // create the array in the key & push the entryContent into the key
                            $entriesDisplay[$entryContent['month']] = array();
                            array_push($entriesDisplay[$entryContent['month']], $entryContent);
                        }
                    }
                } else if ($entryGroup === "weekly") {
                    // for current year & month & weeknumber
                    if ($entryContent['year'] == $thisYear and $entryContent['month'] == $thisMonth and $entryContent['week'] == $thisWeek) {
                        // check if the keyname exists in the $entriesDisplay
                        if (array_key_exists($entryContent['dayname'], $entriesDisplay)) {
                            // push the entryContent into the key
                            array_push($entriesDisplay[$entryContent['dayname']], $entryContent);
                        } else {
                            // create the array in the key & push the entryContent into the key
                            $entriesDisplay[$entryContent['dayname']] = array();
                            array_push($entriesDisplay[$entryContent['dayname']], $entryContent);
                        }
                    }
                }
            }
            return $entriesDisplay;
        }
        $req->closeCursor();
    }

    public function getEntry($entryId, $userId){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT title
        , text_content
        , location
        , weather
        , last_edited
        , date_created 
        , DAY(last_edited) as day
        , MONTHNAME(last_edited) as month
        , YEAR(last_edited) as year
        , TIME_FORMAT(last_edited, "%h:%i %p") as time
        FROM entries
        WHERE user_uid = :userId AND u_id = :entryId AND is_active = :active');
        $req->execute(array(
            'userId' => $userId,
            'entryId' => $entryId,
            'active' => 1
        ));
        $entryContent = $req->fetch(PDO::FETCH_ASSOC);

        $imagesReq = $db->prepare('SELECT path FROM entry_images WHERE entry_uid = ?');
        $imagesReq->execute(array($entryId));
        $images = $imagesReq->fetchAll(PDO::FETCH_ASSOC);
        $entryContent['images'] = $images;
        
        return $entryContent;
        $req->closeCursor();
    }

    public function getImages($uid){

        $db = $this->dbConnect();
        // check if UID already exists
        // fetch matching unique IDs
        $query = $db->prepare('SELECT u_id from entries WHERE u_id = :u_id');
        $query->bindParam('u_id', $uid, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAlbum(){
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT x.u_id, x.title, x.date_created,
        GROUP_CONCAT(y.path SEPARATOR ', ') as paths
        FROM ENTRIES x
        JOIN ENTRY_IMAGES y ON y.entry_uid = x.u_id
        GROUP BY x.u_id ");

        $req -> execute();
        $res = $req -> fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}

