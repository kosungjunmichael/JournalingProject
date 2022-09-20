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

    public function getEntries($userId){
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT 
        u_id
        , title
        , text_content
        , last_edited
        , DAY(last_edited) as day
        , MONTHNAME(last_edited) as month
        , YEAR(last_edited) as year
        FROM entries WHERE user_id = :userId GROUP BY last_edited');
        $req->execute(array(
            'userId' => $userId,
        ));
        $monthEntries = array();
        while($entryContent = $req->fetch(PDO::FETCH_ASSOC)){
            if (array_key_exists($entryContent['month'], $monthEntries)){
                array_push($monthEntries[$entryContent['month']], $entryContent);
                } else {
                    $monthEntries[$entryContent['month']] = array();
                    array_push($monthEntries[$entryContent['month']], $entryContent);
                }
            }
        return $monthEntries;
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

