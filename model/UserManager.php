<?php

require_once('Manager.php');

class UserManager extends Manager{

    public function confirmUser($credentials, $type) {
        $db = $this->dbConnect();
        
        // google login
        if ($type === "google"){

            $inputUser = $credentials['email'];
            
            $req = $db->prepare('SELECT u_id, is_active FROM users WHERE email = ?');
            $req->bindParam(1,$inputUser,PDO::PARAM_STR);
            $req->execute();
            $user = $req->fetch(PDO::FETCH_ASSOC);
            // echo "<pre>";
            // print_r($credentials);
            // echo "<pre>";
            
            
            if ($user['is_active'] === 1){
                // if correct, head to the timelineView
                $_SESSION['uid'] = $user['u_id'];
                return false;
            } else {
                return array(
                    "error" => "User with those credentials does not exist. Please try again.",
                    "username" => ""
                );
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

            // print_r($credentials);
            // echo "USER:", $user;
    
            // catch login errors
            if (!$user
                OR ($credentials['login-ue'] !== $user['username'] AND $credentials['login-ue'] !== $user['email'])
                OR (!password_verify($credentials['login-p'], $user['password']))
                OR $user['is_active'] === 0) {
                    $_SESSION['uid'] = $user['u_id'];
                    return array(
                        "error" => "User with those credentials does not exist. Please try again.",
                        "username" => ""
                    );
            }
            // session_start();
            
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

//    protected function checkRegularLogin(){
//
//    }

    protected function checkGoogleUserExist($credentials){
        $db = $this->dbConnect();
        // check if user already exists
        // fetch matching user email field
        $query = $db->prepare('SELECT email from users WHERE email = :email');
        $query->bindParam('email', $credentials['email'], PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    protected function checkRegularUserExist($credentials){
        $db = $this->dbConnect();
        $query = $db->prepare('SELECT username FROM users WHERE username = ?');
        $query->bindParam(1,$credentials['sign-u'], PDO::PARAM_STR);
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
            $existingUser = $this->checkGoogleUserExist($credentials);
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
                // user already exists, sign in with google credentials, will return false
                return $this->confirmUser($credentials, 'google');
            }
        } else if ($type === 'regular') {
            // creating normal regular user
            
//            $checkUser = $this->checkRegularUserExist($data['sign-u'], 'username');
//            $checkEmail = $this->checkRegularUserExist($data['sign-e'], 'email');

            // if user doesn't exist, create user in database
            $existingUser = $this->checkRegularUserExist($data);
            if (count($existingUser) == 0) {
                $hashpass = password_hash($data['sign-p'], PASSWORD_DEFAULT);

//                if (empty($data['sign-u']) OR
//                empty($data['sign-e']) OR
//                empty($data['sign-p']) OR
//                empty($data['sign-cp'])){
//                    return "Fill in all parameters";
//                } else if (){
//                    return "Fill in all parameters";
//                }

                // if conditions met, create user in database

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
                return false;
            } else {
                return array(
                    'error' => "User with these credentials already exists. Please log in.",
                    'username' => $data['sign-u']
                );
            }
        }
    }
}