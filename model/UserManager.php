<?php

require_once('Manager.php');

class UserManager extends Manager{

    public function confirmUser($credentials, $type) {
        $db = $this->dbConnect();
        // add login user check code

        $inputUser = $credentials['login-ue'];

        // retrieve the user
        $req = $db->prepare('SELECT username, email, password, u_id, is_active FROM users WHERE username = ?');
        $req->bindParam(1,$inputUser,PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);

        // catch login errors
        if ($credentials['login-ue'] != $user['username'] AND $credentials['login-ue'] != $user['email'] ){
            // echo "<pre>";
            // print_r($credentials);
            // echo "<pre>";
            // echo "<pre>";
            // print_r($user);
            // echo "<pre>";
            header ('location: ./index.php?action=error&error=1');
        } else if (!password_verify($credentials['login-p'], $user['password'])){
            header ('location: ./index.php?action=error&error=2');
        } else if ($user['is_active'] != 1){
            header ('location: ./index.php?action=error&error=3');
        }
        $uid = $user['u_id'];

        session_start();
        $_SESSION['uid'] = $uid;

        // create session variable for user login/signup
        // if ($type === 'regular'){
        //     session_start();
        //     $_SESSION['uid'] = $uid;
        // } else if ($type === 'google'){
        //     session_start();
        //     $_SESSION['uid'] = $uid;
        // }

        // if done head to the registered page
        header ('location: ./index.php?action=timeline&type=registered');
    }

    public function updateLastActive($uid){
        $db = $this->dbConnect();
        
        $update = $db->prepare("UPDATE users SET last_active = NOW() WHERE u_id = :uid");
        $update->execute(array('uid' => $uid));
    }

    protected function checkUserNotExist($credentials){
        $db = $this->dbConnect();
        // check if user already exists
        // fetch matching user email field
        $query = $db->prepare('SELECT email from users WHERE email = :email');
        $query->bindParam('email', $credentials['email'], PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    protected function checkUniqueIDExist($uid){
        $db = $this->dbConnect();
        // check if UID already exists
        // fetch matching unique IDs
        $query = $db->prepare('SELECT u_id from users WHERE u_id = :u_id');
        $query->bindParam('u_id', $uid, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    public function createUser($data, $type){
        $db = $this->dbConnect();
        // create unique ID, check if it's actually unique
        do {
            $uid = $this->uidCreate();
            $existingUID = $this->checkUniqueIDExist($uid);
        } while (count($existingUID) > 0);

        // creating Google User
        if ($type === 'google') {
            // convert to array with encode/decode
            $credentials = json_decode(json_encode($data), true);

            // if user doesn't exist, create user in database
            $existingUser = $this->checkUserNotExist($credentials, 'signup');
            if (count($existingUser) == 0) {
                // create a new user into users database table
                $req = $db->prepare('INSERT INTO users (username, u_id, email) VALUES (:login, :u_id, :email)');
                $req->bindParam('login', $credentials['email'], PDO::PARAM_STR);
                $req->bindParam('email', $credentials['email'], PDO::PARAM_STR);
                $req->bindParam('u_id', $uid, PDO::PARAM_STR);
                $req->execute();

                // create session variable for user login/signup
                session_start();
                $_SESSION['uid'] = $uid;

                // redirect to index with registered type
                header ('location: ./index.php?action=timeline&type=registered');
            } else {
                // user already exists, cannot be created
                echo "User with that email already exists. Please try again";
            }
        } else if ($type === 'regular') {
            // creating normal regular user
            if ($data['sign-p'] != $data['sign-cp']){
                // redirect
                header('location: index.php');
            }

            // if user doesn't exist, create user in database
            $existingUser = $this->checkUserNotExist($data, 'signup');
            if (count($existingUser) == 0) {
                $hashpass = password_hash($data['sign-p'], PASSWORD_DEFAULT);

                // create a new user into users database table
                $req = $db->prepare('INSERT INTO users (username, u_id, email, password) VALUES (:login, :u_id, :email, :pass)');
                $req->bindParam('login', $data['sign-u'], PDO::PARAM_STR);
                $req->bindParam('u_id', $uid, PDO::PARAM_STR);
                $req->bindParam('email', $data['sign-e'], PDO::PARAM_STR);
                $req->bindParam('pass', $hashpass, PDO::PARAM_STR);
                $req->execute();

                // create session variable for user login/signup
                session_start();
                $_SESSION['uid'] = $uid;

                // redirect to index with registered type
                header ('location: ./index.php?action=timeline&type=registered');
            } else {
                // user already exists, cannot be created
                echo "User with that email already exists. Please try again";
            }
        }
    }
}