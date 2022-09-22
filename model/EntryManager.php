<?php

require_once('Manager.php');

class EntryManager extends Manager{

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
            $req = $db->prepare('INSERT INTO entries (title, text_content, user_id, u_id) VALUES (:title, :entry, :user_id, :uid)');
            $req->bindParam('title', $data->title, PDO::PARAM_STR);
            $req->bindParam('entry', $data->entry, PDO::PARAM_STR);
            $req->bindParam('user_id', $data->userID, PDO::PARAM_STR);
            $req->bindParam('uid', $uid, PDO::PARAM_STR);
            $req->execute();

            // Direct the user to the timeline
            return $data->userID;
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
        FROM entries WHERE user_id = :userId GROUP BY last_edited DESC');
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
        WHERE user_id = :userId AND u_id = :entryId AND is_active = :active');
        $req->execute(array(
            'userId' => $userId,
            'entryId' => $entryId,
            'active' => 1
        ));
        $entryContent = $req->fetch(PDO::FETCH_ASSOC);

        return $entryContent;
        $req->closeCursor();
    }
}

