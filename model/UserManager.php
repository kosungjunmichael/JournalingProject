<!-- this is the model -->
<?php

require_once('Manager.php');

class UserManager extends Manager{
  public function getUsers(){
    $db = $this->dbConnect();

    // retrieve the user
    $req = $db->query('SELECT * FROM users');
  }
}