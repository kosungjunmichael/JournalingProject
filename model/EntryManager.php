<?php

require_once('Manager.php');

class EntryManager extends Manager{
  public function getEntries(){
    $db = $this->dbConnect();

    $req = $db->prepare('SELECT * FROM entries e JOIN users u WHERE user_id = ?');
    $req->execute(array());
    $entries = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $entries;
  }
}

