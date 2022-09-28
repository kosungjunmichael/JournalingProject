<?php

require_once "Manager.php";

class UserManager extends Manager
{
	public function confirmUser($data, $type)
	{
		$db = $this->dbConnect();
		$credentials =
			$type == "google"
				? json_decode(
					base64_decode(
						str_replace(
							"_",
							"/",
							str_replace("-", "+", explode(".", $data["credential"])[1])
						)
					),
					true
				)
				: $data;

		switch ($type) {
			case "google":
			case "kakao":
				$req = $db->prepare(
					"SELECT u_id, login_type, is_active FROM users WHERE email = ?"
				);
				$req->bindParam(1, $credentials["email"], PDO::PARAM_STR);
				$req->execute();
				$user = $req->fetch(PDO::FETCH_ASSOC);

				// $_SESSION['uid'] = $user['is_active'] === 1 ? (isset($user['u_id']) ? $user['u_id'] : null) : null;
				if ($user["login_type"] === $type and $user["is_active"] === 1) {
					// if correct, head to the timelineView
					if (isset($user["u_id"])) {
						$_SESSION["uid"] = $user["u_id"];
					}
					return false;
				} else {
					return "Login Failed. Please try again.";
				}
				break;
			default:
				// retrieve the user
				$req = $db->prepare(
					"SELECT u_id, username, email, password, is_active FROM users WHERE ? IN(username, email)"
				);
				$req->bindParam(1, $data["login-ue"], PDO::PARAM_STR);
				$req->execute();
				$user = $req->fetch(PDO::FETCH_ASSOC);

				// echo "USER:", $user;

				// catch login errors
				if (
					!$user or
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

				// if correct, head to the timelineView
				return false;
				break;
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

	protected function checkUniqueIDExist($uid)
	{
		$db = $this->dbConnect();
		// check if UID already exists
		// fetch matching unique IDs
		$query = $db->prepare("SELECT u_id from users WHERE u_id = :inUID");
		$query->bindParam("inUID", $uid, PDO::PARAM_STR);
		$query->execute();
		return $query->fetchAll();
	}

	public function createUser($data, $type)
	{
		$db = $this->dbConnect();

		// CREATES A UNIQUE ID AND CHECKS TO SEE IF ID ALREADY EXISTS
		// IF YES, CREATE ANOTHER ONE AND CHECK AGAIN
		// IF NO, RETAIN UID AND CONTINUE WITH CODE
		do {
			$uid = $this->uidCreate();
			$existingUID = $this->checkUniqueIDExist($uid);
		} while (count($existingUID) > 0);

		$credentials =
			$type == "google"
				? json_decode(
					base64_decode(
						str_replace(
							"_",
							"/",
							str_replace("-", "+", explode(".", $data["credential"])[1])
						)
					),
					true
				)
				: $data;
		$existingUser = $this->checkUserExist($credentials, $type);
		switch ($type) {
			case "google":
			case "kakao":
				if ($existingUser and $existingUser["login_type"] == $type) {
					return $this->confirmUser($credentials, $type);
				} elseif ($existingUser and $existingUser["login_type"] != $type) {
					$username = "";
					$email = "";
					foreach ($existingUser as $value) {
						$username =
							$value["username"] == $existingUser["sign-u"]
								? $value["username"]
								: null;
						$email =
							$value["email"] == $existingUser["sign-e"]
								? $value["email"]
								: null;
					}
					if ($username and $email) {
						return "Username and email already exist. Please try different ones.";
					} elseif ($username and !$email) {
						return "Username already exists. Please try a different one.";
					} else {
						return "Email already exists. Please try a different one.";
					}
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
				break;
			default:
				if ($existingUser) {
					$username = "";
					$email = "";
					foreach ($existingUser as $value) {
						if ($value["username"] == $credentials["sign-u"]) {
							$username = $value["username"];
						}
						if ($value["email"] == $credentials["sign-e"]) {
							$email = $value["email"];
						}
					}
					if ($username and $email) {
						return "Username and email already exist. Please try different ones.";
					} elseif ($username and !$email) {
						return "Username already exists. Please try a different one.";
					} else {
						return "Email already exists. Please try a different one.";
					}
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
				break;
		}
	}
}
