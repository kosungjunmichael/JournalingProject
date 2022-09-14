<!-- this is the model -->
<?php

require_once('Manager.php');

class UserManager extends Manager{
    public function getUsers(){
        $db = $this->dbConnect();

        // retrieve the user
        $req = $db->query('SELECT * FROM users');
    }

    public function confirmUser($credentials, $type) {
        $db = $this->dbConnect();

        if ($type === 'signup') {
            // check if user already exists
            // fetch matching user email field
            $query = $db->prepare('SELECT email from users WHERE email = :email');
            $query->bindParam('email', $credentials['email'], PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll();
        } else if ($type === 'login') {
            // add login user check code

        }
    }

    public function createUser($data, $type){
        $db = $this->dbConnect();

        // creating Google User
        if ($type === 'google') {
            // convert to array with encode/decode
            $credentials = json_decode(json_encode($data), true);

            // if user doesn't exist, create user in database
            $existingUser = $this->confirmUser($credentials, 'signup');
            if (count($existingUser) == 0) {
                // create a new user into users database table
                $req = $db->prepare('INSERT INTO users (username, email) VALUES (:login, :email)');
                $req->bindParam('login', $credentials['email'], PDO::PARAM_STR);
                $req->bindParam('email', $credentials['email'], PDO::PARAM_STR);
                $req->execute();
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
            $existingUser = $this->confirmUser($data, 'signup');
            if (count($existingUser) == 0) {
                $hashpass = password_hash($data['sign-p'], PASSWORD_DEFAULT);

                // create a new user into users database table
                $req = $db->prepare('INSERT INTO users (username, email, password) VALUES (:login, :email, :pass)');
                $req->bindParam('login', $data['sign-u'], PDO::PARAM_STR);
                $req->bindParam('email', $data['sign-e'], PDO::PARAM_STR);
                $req->bindParam('pass', $hashpass, PDO::PARAM_STR);
                $req->execute();
                // redirect to index with registered type
                header ('location: ./index.php?action=timeline&type=registered');
            } else {
                // user already exists, cannot be created
                echo "User with that email already exists. Please try again";
            }
        }
    }
}