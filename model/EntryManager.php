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
        return;
        // header ('location: ./index.php?action=timeline&type=registered');
    }

    public function newEntryFailed(){
        // Redirect the user back to the createNewEntry page
        header("Location: ./view/createEntryView.php");
    }

    public function getEntries(){
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM entries e JOIN users u WHERE user_id = ?');
        $req->execute(array());
        $entries = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $entries;
    }
}

