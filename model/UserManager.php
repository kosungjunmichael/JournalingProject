<?php

require_once('Manager.php');

class UserManager extends Manager{

    public function confirmUser($credentials, $type) {
        $db = $this->dbConnect();
        
        // google login
        if ($type === "google"){

            $inputUser = $credentials->email;
            
            $req = $db->prepare('SELECT u_id, is_active FROM users WHERE email = ?');
            $req->bindParam(1,$inputUser,PDO::PARAM_STR);
            $req->execute();
            $user = $req->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['uid'] = $user['u_id'];

            if ($user['is_active'] === 1){
                // if correct, head to the timelineView
                return false;
            } else {
                return "user doesn't exist";
            }
        // regular login
        } else if ($type === "regular"){
            // add login user check code
    
            $inputUser = $credentials['login-ue'];
    
            // retrieve the user
            $req = $db->prepare('SELECT username, email, password, u_id, is_active FROM users WHERE username = ?');
            $req->bindParam(1,$inputUser,PDO::PARAM_STR);
            $req->execute();
            $user = $req->fetch(PDO::FETCH_ASSOC);
    
            // catch login errors
            if ($credentials['login-ue'] != $user['username'] AND $credentials['login-ue'] != $user['email']){
                return "user doesn't exist";
            } else if (!password_verify($credentials['login-p'], $user['password'])){
                return "password was incorrect";
            } else if ($user['is_active'] != 1){
                return "user is not active";
            }
            // session_start();
            $_SESSION['uid'] = $user['u_id'];
            
            // if correct, head to the timelineView
            return false;
        }
    }

    public function updateLastActive($uid){
        $db = $this->dbConnect();
        
        // update the last active for the user
        $update = $db->prepare("UPDATE users SET last_active = NOW() WHERE u_id = :uid");
        $update->execute(array('uid' => $uid));
    }

    protected function checkGoogleUserExist($credentials){
        $db = $this->dbConnect();
        // check if user already exists
        // fetch matching user email field
        $query = $db->prepare('SELECT email from users WHERE email = :email');
        $query->bindParam('email', $credentials['email'], PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    // protected function checkRegularUserExist(){
    //     $db = $this->dbConnect();


    // }

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
            $existingUser = $this->checkGoogleUserExist($credentials, 'signup');
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
                // header ('location: ./index.php?action=timeline&type=registered');
                return false;
            } else {
                // user already exists, cannot be created
                return "existingEmail";
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

                if (empty($data['sign-u']) OR 
                empty($data['sign-e']) OR
                empty($data['sign-p']) OR 
                empty($data['sign-cp'])){
                    return "Fill in all parameters";
                } else if (){
                    return "Fill in all parameters";
                }

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
                return false;
            }
        }
    }
}