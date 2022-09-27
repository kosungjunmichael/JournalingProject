<?php

require_once('Manager.php');

class UserManager extends Manager{

    public function confirmUser($data, $type) {
        $db = $this->dbConnect();
        $credentials = $type == 'google' ? json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $data['credential'])[1]))), true) : $data;

        switch ($type) {
            case 'google':
            case 'kakao':
                $req = $db->prepare('SELECT u_id, login_type, is_active FROM users WHERE email = ?');
                $req->bindParam(1, $credentials['email'], PDO::PARAM_STR);
                $req->execute();
                $user = $req->fetch(PDO::FETCH_ASSOC);

                // $_SESSION['uid'] = $user['is_active'] === 1 ? (isset($user['u_id']) ? $user['u_id'] : null) : null;
                if ($user['login_type'] === $type AND $user['is_active'] === 1) {
                    // if correct, head to the timelineView
                    if (isset($user['u_id'])) {
                        $_SESSION['uid'] = $user['u_id'];
                    }
                    return false;
                } else {
                    return "Login Failed. Please try again.";
                    // return array(
                    //     "error" => "Login Failed. Please try again.",
                    // );
                }
                break;
            default:
                // add login user check code

                // regular login will use the login name from the form to confirm
                // $inputUser = $credentials['login-ue'];

                // retrieve the user
                $req = $db->prepare('SELECT u_id, username, email, password, is_active FROM users WHERE ? IN(username, email)');
                $req->bindParam(1, $data['login-ue'], PDO::PARAM_STR);
                $req->execute();
                $user = $req->fetch(PDO::FETCH_ASSOC);

                // echo "USER:", $user;
                
                // catch login errors
                if (
                    !$user
                    OR ($data['login-ue'] !== $user['username'] and $data['login-ue'] !== $user['email'])
                    OR (!password_verify($data['login-p'], $user['password']))
                    OR $user['is_active'] === 0
                    ) {
                        return "Login Failed. Please try again.";
                        // return array(
                        //     "error" => "User with those credentials does not exist. Please try again.",
                        //     "username" => ""
                        // );
                    }

                if (isset($user['u_id'])) {
                    $_SESSION['uid'] = $user['u_id'];
                }
                    
                // if correct, head to the timelineView
                return false;
                break;
        }
    }

    public function updateLastActive($uid){
        $db = $this->dbConnect();
        
        // update the last active for the user
        $update = $db->prepare("UPDATE users SET last_active = NOW() WHERE u_id = :uid");
        $update->execute(array('uid' => $uid));
    }

    protected function checkUserExist($credentials, $type) {
        $db = $this->dbConnect();
        $query = $db->prepare('SELECT login_type, username, email FROM users WHERE username = :inUsername OR email = :inEmail');

        switch ($type) {
            case 'google':
            case 'kakao':
                $query->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
                $query->bindParam('inEmail', $credentials['email'], PDO::PARAM_STR);
                break;
            default:
                $query->bindParam('inUsername', $credentials['sign-u'], PDO::PARAM_STR);
                $query->bindParam('inEmail', $credentials['sign-e'], PDO::PARAM_STR);
                break;
        }
        // if (isset($credentials['iss'])) {
        //     $query->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
        //     $query->bindParam('inEmail', $credentials['email'], PDO::PARAM_STR);
        // } else if($credentials['action'] == 'kakaoSignUp') {
        //     $query->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
        //     $query->bindParam('inEmail', $credentials['email'], PDO::PARAM_STR);
        // } else {
        //     $query = $db->prepare('SELECT username, email FROM users WHERE username = :inUsername OR email = :inEmail');
        //     $query->bindParam('inUsername', $credentials['sign-u'], PDO::PARAM_STR);
        //     $query->bindParam('inEmail', $credentials['sign-e'], PDO::PARAM_STR);
        // }

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
        // return $query->fetchAll();
        // $query = $db->prepare('SELECT email from users WHERE username = :inEmail');
        // $query->bindParam('inEmail', $credentials['email'], PDO::PARAM_STR);
        // $query->execute();
        // return $query->fetch();
    }

    // protected function checkGoogleUserExist($credentials){
    //     $db = $this->dbConnect();

    //     $query = $db->prepare('SELECT username from users WHERE username = :inUsername');
    //     $query->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
    //     $query->execute();
    //     return $query->fetch();
    // }

    // protected function checkRegularUserExist($credentials){
    //     $db = $this->dbConnect();

    //     $query = $db->prepare('SELECT username, email FROM users WHERE username = :inUsername OR email = :inEmail');
    //     $query->bindParam('inUsername',$credentials['sign-u'], PDO::PARAM_STR);
    //     $query->bindParam('inEmail',$credentials['sign-e'], PDO::PARAM_STR);
    //     $query->execute();
    //     return $query->fetchAll();
    // }

    // protected function checkKakaoUserExist($credentials){
    //     $db = $this->dbConnect();

    //     $query = $db->prepare('SELECT username from users WHERE username = :inUsername');
    //     $query->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
    //     $query->execute();
    //     return $query->fetch();
    // } 


    protected function checkUniqueIDExist($uid){
        $db = $this->dbConnect();
        // check if UID already exists
        // fetch matching unique IDs
        $query = $db->prepare('SELECT u_id from users WHERE u_id = :inUID');
        $query->bindParam('inUID', $uid, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    public function createUser($data, $type){
        $db = $this->dbConnect();

        // CREATES A UNIQUE ID AND CHECKS TO SEE IF ID ALREADY EXISTS
        // IF YES, CREATE ANOTHER ONE AND CHECK AGAIN
        // IF NO, RETAIN UID AND CONTINUE WITH CODE
        do {
            $uid = $this->uidCreate();
            $existingUID = $this->checkUniqueIDExist($uid);
        } while (count($existingUID) > 0);
        
        $credentials = $type == 'google' ? json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $data['credential'])[1]))), true) : $data;
        // return $credentials;
        $existingUser = $this->checkUserExist($credentials, $type);
        // return $existingUser;
        switch ($type) {
            case 'google':
            case 'kakao':
                if ($existingUser and $existingUser['login_type'] == $type) {
                    return $this->confirmUser($credentials, $type);
                } else if ($existingUser and $existingUser['login_type'] != $type) {
                    $username = '';
                    $email = '';
                    foreach ($existingUser as $value) {
                        $username = $value['username'] == $existingUser['sign-u'] ? $value['username'] : null;
                        $email = $value['email'] == $existingUser['sign-e'] ? $value['email'] : null;
                    }
                    if ($username AND $email) {
                        return "Username and email already exist. Please try different ones.";
                    } else if ($username AND !$email) {
                        return "Username already exists. Please try a different one.";
                    } else {
                        return "Email already exists. Please try a different one.";
                    }
                    // return array(
                    //     'error' => "User with these credentials already exists:",
                    //     'username' => $username,
                    //     'email' => $email
                    // );
                } else {
                    $req = $db->prepare('INSERT INTO users (u_id, login_type, username, email) VALUES (:inUID, :inLoginType, :inUsername, :inEmail)');
                    $req->bindParam('inUID', $uid, PDO::PARAM_STR);
                    $req->bindParam('inLoginType', $type, PDO::PARAM_STR);
                    $req->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
                    $req->bindParam('inEmail', $credentials['email'], PDO::PARAM_STR);
                    $req->execute();

                    // CREATE SESSION VARIABLE FOR USER UID
                    // session_start();
                    $_SESSION['uid'] = $uid;
                    // if (isset($user['u_id'])){
                    //     $_SESSION['uid'] = $user['u_id'];
                    // }

                    // redirect to index with registered type
                    return false;
                }
                // $credentials = $type == 'google' ? json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $data['credential'])[1]))), true) : $data;
                // CONVERTS JWT GIVEN BY GOOGLE TO A READABLE ARRAY
                // $credentials = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $data['credential'])[1]))), true);
                // return $credentials;

                // CHECKS TO SEE IF USER WITH GOOGLE CREDENTIALS ALREADY EXIST IN DB
                // $existingUser = $this->checkUserExist($credentials, $type);
                // // IF YES, SIGN IN WITH GOOGLE CREDENTIALS INSTEAD
                // // IF NO, PROCEED WITH CREATING A NEW USER WITH GIVEN CREDENTIALS
                // if (!$existingUser) {
                //     $req = $db->prepare('INSERT INTO users (u_id, login_type, username, email) VALUES (:inUID, :inLoginType, :inUsername, :inEmail)');
                //     $req->bindParam('inUID', $uid, PDO::PARAM_STR);
                //     $req->bindParam('inLoginType', $type, PDO::PARAM_STR);
                //     $req->bindParam('inUsername', $credentials['email'], PDO::PARAM_STR);
                //     $req->bindParam('inEmail', $credentials['email'], PDO::PARAM_STR);
                //     $req->execute();

                //     // CREATE SESSION VARIABLE FOR USER UID
                //     // session_start();
                //     $_SESSION['uid'] = $uid;
                //     // if (isset($user['u_id'])){
                //     //     $_SESSION['uid'] = $user['u_id'];
                //     // }

                //     // redirect to index with registered type
                //     return false;
                // } else {
                //     // user already exists, sign in with google credentials, will return false
                //     return $this->confirmUser($credentials, 'google');
                // }
                break;
            default:
                if ($existingUser) {
                    // return $existingUser;
                    $username = '';
                    $email = '';
                    foreach ($existingUser as $value) {
                        if ($value['username'] == $credentials['sign-u']) {
                            $username = $value['username'];
                        }

                        if ($value['email'] == $credentials['sign-e']) {
                            $email = $value['email'];
                        }
                        // $username = $value['username'] == $credentials['sign-u'] ? $value['username'] : null;
                        // $email = $value['email'] == $credentials['sign-e'] ? $value['email'] : null;
                    }
                    if ($username and $email) {
                        return "Username and email already exist. Please try different ones.";
                    } else if ($username and !$email) {
                        return "Username already exists. Please try a different one.";
                    } else {
                        return "Email already exists. Please try a different one.";
                    }
                    // return array(
                    //     'error' => "User with these credentials already exists. Please log in.",
                    //     'username' => $username,
                    //     'email' => $email
                    // );
                } else {
                    $hashpass = password_hash($credentials['sign-p'], PASSWORD_DEFAULT);

                    // create a new user into users database table
                    $req = $db->prepare('INSERT INTO users (u_id, login_type, username, email, password) VALUES (:inUID, :inLoginType, :inUsername, :inEmail, :inPassword)');
                    $req->bindParam('inUID', $uid, PDO::PARAM_STR);
                    $req->bindParam('inLoginType', $login_type, PDO::PARAM_STR);
                    $req->bindParam('inUsername', $credentials['sign-u'], PDO::PARAM_STR);
                    $req->bindParam('inEmail', $credentials['sign-e'], PDO::PARAM_STR);
                    $req->bindParam('inPassword', $hashpass, PDO::PARAM_STR);
                    $req->execute();

                    // create session variable for user login/signup
                    $_SESSION['uid'] = $uid;
                    // if (isset($user['u_id'])) {
                    //     $_SESSION['uid'] = $user['u_id'];
                    // }

                    // redirect to index with registered type
                    return false;
                }

                    // if user doesn't exist, create user in database
                    // $existingUser = $this->checkUserExist($data, $type);
                    // if (!$existingUser) {

                    //     // if (empty($data['sign-u']) OR
                    //     // empty($data['sign-e']) OR
                    //     // empty($data['sign-p']) OR
                    //     // empty($data['sign-cp'])){
                    //     //     return "Fill in all parameters";
                    //     // } else if (){
                    //     //     return "Fill in all parameters";
                    //     // }

                    //     // if conditions met, create user in database

                    //     $hashpass = password_hash($data['sign-p'], PASSWORD_DEFAULT);

                    //     // create a new user into users database table
                    //     $req = $db->prepare('INSERT INTO users (u_id, login_type, username, email, password) VALUES (:inUID, :inLoginType, :inUsername, :inEmail, :inPassword)');
                    //     $req->bindParam('inUID', $uid, PDO::PARAM_STR);
                    //     $req->bindParam('inLoginType', $login_type, PDO::PARAM_STR);
                    //     $req->bindParam('inUsername', $data['sign-u'], PDO::PARAM_STR);
                    //     $req->bindParam('inEmail', $data['sign-e'], PDO::PARAM_STR);
                    //     $req->bindParam('inPassword', $hashpass, PDO::PARAM_STR);
                    //     $req->execute();

                    //     // create session variable for user login/signup
                    //     $_SESSION['uid'] = $uid;
                    //     // if (isset($user['u_id'])) {
                    //     //     $_SESSION['uid'] = $user['u_id'];
                    //     // }

                    //     // redirect to index with registered type
                    //     return false;
                    // } else {
                    //     return array(
                    //         'error' => "User with these credentials already exists. Please log in.",
                    //         'username' => $data['sign-u'],
                    //         'email' => $data['sign-e']
                    //     );
                    // }
                // } 
                // else {
                    // return "sign up failed";
                    // $error = '';
                //     $error = [];
                //     foreach ($control as $value) {
                //         // if ($value != '1') $error .= $value . '<br>';
                //         if ($value != '1') array_push($error, $value);
                //     }
                //     return $error;
                // }
                break;
        }
    }
}
