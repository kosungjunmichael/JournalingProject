<!-- this is the model -->
<?php

require_once('Manager.php');

class UserManager extends Manager{

    public function confirmUser($credentials, $type) {
        $db = $this->dbConnect();

        if ($type === 'signup') {
            // check if user exists
            $query = $db->prepare('SELECT email from users WHERE email = :email');
            $query->bindParam('email', $credentials['email'], PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll();
        } else if ($type === 'login') {
            // add login user check code

            $inputUser = $credentials['log-u'];

            // retrieve the user
            $req = $db->prepare('SELECT * FROM users WHERE username = ?');
            $req->bindParam(1,$inputUser,PDO::PARAM_STR);
            $req->execute();
            $users = $req->fetchAll(PDO::FETCH_ASSOC);

            if ($credentials['log-u'] != $users['username'] OR $credentials['log-u'] != $users['email'] ){
                header ('location: ./index.php?error=1');
            } else if (!password_verify($credentials['log-p'], $users['password'])){
                header ('location: ./index.php?error=2');
            } else if ($users['is_active'] != 1){
                header ('location: ./index.php?error=3');
            }
        
        // $update = $db->prepare("UPDATE users SET last_logged_in = NOW() WHERE username = ?");
        // $update->execute(array($inputUser));

        header ('location: ./index.php?action=timeline&type=registered');
        }
    }

    public function createUser($data, $type){
        $db = $this->dbConnect();

        // creating Google User
        if ($type === 'google') {
            // convert from  to array
            $credentials = json_decode(json_encode($data), true);
            $existingUser = $this->confirmUser($credentials, 'signup');

            // if user doesn't exist, create user in database
            if (count($existingUser) == 0) {
                // create a new user into users database table
                $req = $db->prepare('INSERT INTO users (username, email) VALUES (:login, :email)');
                $req->bindParam('login', $credentials['email'], PDO::PARAM_STR);
                $req->bindParam('email', $credentials['email'], PDO::PARAM_STR);
                $req->execute();
            }
            // redirect
//            header ('location: ./index.php?action=timeline&type=registered');
        } else if ($type === 'regular') {
            // creating normal regular user
            if ($data['sign-p'] != $data['sign-cp']){
                // redirect
                header('location: index.php');
            }
            $hashpass = password_hash($data['sign-p'], PASSWORD_DEFAULT);

            // We create a new user
            $req = $db->prepare('INSERT INTO users (username, email, password) VALUES (:login, :email, :pass)');
            $req->bindParam('login', $data['sign-u'], PDO::PARAM_STR);
            $req->bindParam('email', $data['sign-e'], PDO::PARAM_STR);
            $req->bindParam('pass', $hashpass, PDO::PARAM_STR);
            $req->execute();
            // redirect
            header ('location: ./index.php?action=timeline&type=registered');
        }
    }
}