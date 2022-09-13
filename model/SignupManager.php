<?php

require_once('Manager.php');

class SignupManager extends Manager{
  public function createUser($data){
    $db = $this->dbConnect();

    if ($data['sign-p'] != $data['sign-cp']){
      header('location: index.php');
    }
    $hashpass = password_hash($data['sign-p'], PASSWORD_DEFAULT);

    // We create a new user
    $req = $db->prepare('INSERT INTO users (username, email, password) VALUES (:login, :email, :pass)');
    $req->bindParam('login', $data['sign-u'], PDO::PARAM_STR);
    $req->bindParam('email', $data['sign-e'], PDO::PARAM_STR);
    $req->bindParam('pass', $hashpass, PDO::PARAM_STR);
    $req->execute();
    header ('location: ../index.php?action=signin?type=registered');
  }
}