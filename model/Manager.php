<?php

class Manager
{
	protected function dbConnect()
	{
		return new PDO(
			"mysql:host=localhost;dbname=journal_project;charset=utf8",
			"root",
			""
		);
	}

    protected function getEnt($request, $userUID, $entryUID = null)
    {
        $db = $this->dbConnect();

        switch ($request){
            case "allEntries":
                $req = $db->prepare('SELECT
                e.u_id
                , e.title
                , e.location
                , e.lat_lng
                , e.text_content
                , e.date_created
                , e.last_edited
                , DAYNAME(e.last_edited) as dayname
                , DAY(e.last_edited) as day
                , WEEK(e.last_edited) as week
                , MONTHNAME(e.last_edited) as month
                , YEAR(e.last_edited) as year
                , GROUP_CONCAT(t.tag_name) as tags
                -- add GROUP_CONCAT function here. give it an alias like "as tags" 
                FROM entries e
                LEFT JOIN tag_map tm ON e.u_id = tm.entry_id
                LEFT JOIN tags t ON t.id = tm.tag_id
                WHERE e.user_uid = :userId
                AND e.is_active = 1
                GROUP BY last_edited DESC');
                $req->execute([
                    "userId" => $userUID
                ]);
                return $req->fetchAll(PDO::FETCH_ASSOC);
                $req->closeCursor();
            break;
            case "singleEntry":
                $req = $db->prepare('SELECT e.title
                , e.u_id
                , e.text_content
                , e.location
                , e.weather
                , e.last_edited
                , e.date_created
                , DAY(e.last_edited) as day
                , MONTHNAME(e.last_edited) as month
                , YEAR(e.last_edited) as year
                , TIME_FORMAT(e.last_edited, "%h:%i %p") as time
                , GROUP_CONCAT(t.tag_name) as tags
                FROM entries e
                LEFT JOIN tag_map tm ON e.u_id = tm.entry_id
                LEFT JOIN tags t ON t.id = tm.tag_id
                WHERE e.user_uid = :userId 
                AND e.u_id = :entryId 
                AND e.is_active = 1');
                $req->execute([
                    "userId" => $userUID,
                    "entryId" => $entryUID,
                ]);
                return $req->fetch(PDO::FETCH_ASSOC);
                $req->closeCursor();
            break;
            default:
            break;
        }

    }

    protected function checkUniqueIDExist($type)
    {
        switch ($type){
            case "entries":
                $db = $this->dbConnect();
        
                $req = $db->query('SELECT ALL u_id FROM entries WHERE is_active = 1');
                return $req->fetchAll(PDO::FETCH_ASSOC);
                break;
            case "users":
                $db = $this->dbConnect();
        
                $req = $db->query('SELECT ALL u_id FROM users WHERE is_active = 1');
                return $req->fetchAll(PDO::FETCH_ASSOC);
            break;
            default:
            break;
        }
    }

	protected function uidCreate()
	{
		if (!function_exists("crypto_rand_secure")) {
			function crypto_rand_secure($min, $max)
			{
				//https://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
				$range = $max - $min;
				if ($range < 1) {
					return $min;
				} // not so random...
				$log = ceil(log($range, 2));
				$bytes = (int) ($log / 8) + 1; // length in bytes
				$bits = (int) $log + 1; // length in bits
				$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
				do {
					$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
					$rnd = $rnd & $filter; // discard irrelevant bits
				} while ($rnd > $range);

				return $min + $rnd;
			}
		}

		$token = "";
		$codeAlphabet = "ABCDEFGHJKLMNPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijkmnopqrstuvwxyz";
		$codeAlphabet .= "123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i = 0; $i < 10; $i++) {
			$token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
		}

		return $token;
	}
}
