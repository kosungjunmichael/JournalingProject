<?php

class Manager {
  protected function dbConnect(){
    return new PDO('mysql:host=localhost;dbname=journal_project;charset=utf8', 'root', '');
  }

  private function crypto_rand_secure($min, $max){
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
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

  protected function uidCreate(){
    $token = "";
    $codeAlphabet = "ABCDEFGHJKLMNPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijkmnopqrstuvwxyz";
    $codeAlphabet.= "123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < 10; $i++) { //LENGTH OF THE UID
        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
    }
    return $token;
  }
}


