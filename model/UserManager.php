<?php

require_once "Manager.php";

class UserManager extends Manager
{
	public function confirmUser($data, $type)
	{
		$db = $this->dbConnect();

		if ($type == "regular") {
			// CHECK TO SEE IF CREDENTIALS MATCH A USER IN DB
			$req = $db->prepare(
				"SELECT u_id, login_type, username, email, password, is_active FROM users WHERE ? IN(username, email)"
			);
			$req->bindParam(1, $data["login-ue"], PDO::PARAM_STR);
			$req->execute();
			$user = $req->fetch(PDO::FETCH_ASSOC);

			// IF NOT, NOTIFY USER LOGIN FAILED
			if (
				!$user or
				$user["login_type"] !== $type or
				$data["login-ue"] !== $user["username"] and
					$data["login-ue"] !== $user["email"] or
				!password_verify($data["login-p"], $user["password"]) or
				$user["is_active"] === 0
			) {
				return "Login Failed. Please try again.";
			}

			if (isset($user["u_id"])) {
				$_SESSION["uid"] = $user["u_id"];
			}

			// IF YES, PROCEED TO USER TIMELINE
			return false;
		} else {
			$req = $db->prepare(
				"SELECT u_id, login_type, is_active FROM users WHERE email = :inEmail"
			);
			$req->bindParam("inEmail", $data["email"], PDO::PARAM_STR);
			$req->execute();
			$user = $req->fetch(PDO::FETCH_ASSOC);

			if (!$user or $user["login_type"] !== $type or $user["is_active"] === 0) {
				// IF NOT, NOTIFY USER LOGIN FAILED
				return "Login Failed. Please try again.";
			} else {
				// IF YES, PROCEED TO USER TIMELINE
				if (isset($user["u_id"])) {
					$_SESSION["uid"] = $user["u_id"];
				}

				return false;
			}
		}
	}

	public function updateLastActive($uid)
	{
		$db = $this->dbConnect();

		// update the last active for the user
		$update = $db->prepare(
			"UPDATE users SET last_active = NOW() WHERE u_id = :uid"
		);
		$update->execute(["uid" => $uid]);
	}

	protected function checkUserExist($credentials, $type)
	{
		$db = $this->dbConnect();
		$query = $db->prepare(
			"SELECT login_type, username, email FROM users WHERE username = :inUsername OR email = :inEmail"
		);

		switch ($type) {
			case "google":
				$query->bindParam("inUsername", $credentials["email"], PDO::PARAM_STR);
				$query->bindParam("inEmail", $credentials["email"], PDO::PARAM_STR);
				break;
			case "kakao":
				$query->bindParam("inUsername", $credentials["email"], PDO::PARAM_STR);
				$query->bindParam("inEmail", $credentials["email"], PDO::PARAM_STR);
				break;
			default:
				$query->bindParam("inUsername", $credentials["sign-u"], PDO::PARAM_STR);
				$query->bindParam("inEmail", $credentials["sign-e"], PDO::PARAM_STR);
				break;
		}

		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	// protected function checkUniqueIDExist($uid)
	// {
	// 	$db = $this->dbConnect();
	// 	// check if UID already exists
	// 	// fetch matching unique IDs
	// 	$query = $db->prepare("SELECT u_id from users WHERE u_id = :inUID");
	// 	$query->bindParam("inUID", $uid, PDO::PARAM_STR);
	// 	$query->execute();
	// 	return $query->fetchAll();
	// }

	protected function signUpErrors($credentials, $existingUser, $type)
	{
		$username = "";
		$email = "";
		foreach ($existingUser as $userData) {
			if ($type == "regular") {
				$username =
					$userData["username"] == $credentials["sign-u"]
						? $userData["username"]
						: null;
				$email =
					$userData["email"] == $credentials["sign-e"]
						? $userData["email"]
						: null;
			} else {
				$username =
					$userData["username"] == $credentials["email"]
						? $userData["username"]
						: null;
				$email =
					$userData["email"] == $credentials["email"]
						? $userData["email"]
						: null;
			}
		}

		if ($username and $email) {
			return "Username and email already exist. Please try different ones.";
		} elseif ($username and !$email) {
			return "Username already exists. Please try a different one.";
		} else {
			return "Email already exists. Please try a different one.";
		}
	}

	public function createRegUser($credentials, $type)
	{
		$db = $this->dbConnect();

		// CREATES A UNIQUE ID AND CHECKS TO SEE IF ID ALREADY EXISTS
		// IF YES, CREATE ANOTHER ONE AND CHECK AGAIN
		// IF NO, RETAIN UID AND CONTINUE WITH CODE
        $userUIDs = $this->checkUniqueIDExist('users');

        foreach($userUIDs as $existingUID){
            do {
                $uid = $this->uidCreate();
                // $existingUID = $this->checkUniqueIDExist($uid);
            } while ($existingUID === $uid);
        }

		$existingUser = $this->checkUserExist($credentials, "regular");

		if ($existingUser) {
			return $this->signUpErrors($credentials, $existingUser, "regular");
		} else {
			$hashpass = password_hash($credentials["sign-p"], PASSWORD_DEFAULT);

			// CREATE NEW USER IN DB
			$req = $db->prepare(
				"INSERT INTO users (u_id, login_type, username, email, password) VALUES (:inUID, :inLoginType, :inUsername, :inEmail, :inPassword)"
			);
			$req->bindParam("inUID", $uid, PDO::PARAM_STR);
			$req->bindParam("inLoginType", $type, PDO::PARAM_STR);
			$req->bindParam("inUsername", $credentials["sign-u"], PDO::PARAM_STR);
			$req->bindParam("inEmail", $credentials["sign-e"], PDO::PARAM_STR);
			$req->bindParam("inPassword", $hashpass, PDO::PARAM_STR);
			$req->execute();

			// CREATE SESSION VARIABLE FOR USER UID
			$_SESSION["uid"] = $uid;

			return false;
		}
	}

	public function createKakaoUser($credentials, $type)
	{
		$db = $this->dbConnect();

		// CREATES A UNIQUE ID AND CHECKS TO SEE IF ID ALREADY EXISTS
		// IF YES, CREATE ANOTHER ONE AND CHECK AGAIN
		// IF NO, RETAIN UID AND CONTINUE WITH CODE
		$userUIDs = $this->checkUniqueIDExist('users');

        foreach($userUIDs as $existingUID){
            do {
                $uid = $this->uidCreate();
                // $existingUID = $this->checkUniqueIDExist($uid);
            } while ($existingUID === $uid);
        }

		$existingUser = $this->checkUserExist($credentials, "kakao");
		if ($existingUser) {
			return $this->signUpErrors($credentials, $existingUser, "kakao");
		} else {
			$req = $db->prepare(
				"INSERT INTO users (u_id, login_type, username, email) VALUES (:inUID, :inLoginType, :inUsername, :inEmail)"
			);
			$req->bindParam("inUID", $uid, PDO::PARAM_STR);
			$req->bindParam("inLoginType", $type, PDO::PARAM_STR);
			$req->bindParam("inUsername", $credentials["email"], PDO::PARAM_STR);
			$req->bindParam("inEmail", $credentials["email"], PDO::PARAM_STR);
			$req->execute();

			// CREATE SESSION VARIABLE FOR USER UID
			$_SESSION["uid"] = $uid;

			return false;
		}
	}

	public function createGoogleUser($credentials, $type)
	{
		$db = $this->dbConnect();

		// CREATES A UNIQUE ID AND CHECKS TO SEE IF ID ALREADY EXISTS
		// IF YES, CREATE ANOTHER ONE AND CHECK AGAIN
		// IF NO, RETAIN UID AND CONTINUE WITH CODE
		$userUIDs = $this->checkUniqueIDExist('users');

        foreach($userUIDs as $existingUID){
            do {
                $uid = $this->uidCreate();
                // $existingUID = $this->checkUniqueIDExist($uid);
            } while ($existingUID === $uid);
        }

		$existingUser = $this->checkUserExist($credentials, $type);
		// echoPre($existingUser);
		if ($existingUser and $existingUser[0]["login_type"] === $type) {
			return $this->confirmUser($credentials, $type);
		} elseif ($existingUser) {
			return $this->signUpErrors($credentials, $existingUser, $type);
		} else {
			$req = $db->prepare(
				"INSERT INTO users (u_id, login_type, username, email) VALUES (:inUID, :inLoginType, :inUsername, :inEmail)"
			);
			$req->bindParam("inUID", $uid, PDO::PARAM_STR);
			$req->bindParam("inLoginType", $type, PDO::PARAM_STR);
			$req->bindParam("inUsername", $credentials["email"], PDO::PARAM_STR);
			$req->bindParam("inEmail", $credentials["email"], PDO::PARAM_STR);
			$req->execute();

			// CREATE SESSION VARIABLE FOR USER UID
			$_SESSION["uid"] = $uid;

			return false;
		}
	}

	public function getUsername($userUID)
	{
		$db = $this->dbConnect();

		$req = $db->prepare("SELECT username FROM users WHERE u_id = ?");
		$req->bindParam(1, $userUID, PDO::PARAM_STR);
		$req->execute();
		return $req->fetch();
	}
}
