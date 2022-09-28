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
