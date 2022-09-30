<?php
 
$text['textContent']=  $_POST['hidden-text']; //for testing temp variable 
$text['uid'] = 2;

require_once("Manager.php");

class EntryEditManager extends Manager{

   // public function entryEdit($response){
   //    if(isset($response)){
   //       $db = $this->dbConnect();
   //       $req = $db->prepare("INSERT INTO entry (user_uid, entry) VALUES (:inUid, :inEntry)");
   //       $req ->execute(array(
   //                'inUid' => $response['uid'],
   //                'inEntry' => htmlspecialchars($response['textContent'])
   //                ));
   //       if($req->rowCount() == 1){
   //          $req->closeCursor();
   //          return 1;
   //       }
   //    }else{
   //       echo "failed";
   //       return 0;
   //    }
   // }

   public function entryDisplay($response){
      $db = $this->dbConnect();
      $req = $db->prepare("SELECT text_content FROM entries WHERE user_uid = :inUid");
      $req->execute(array(
         'inUid' => $response['uid']
      ));
      if($req->rowCount() == 1){
         $result = $req->fetch(PDO::FETCH_ASSOC);
         $req->closeCursor();
         return htmlspecialchars_decode($result['text_content']);
      }else{
      echo "failed";
      return 0;
   }
   }

}


$test = new EntryEditManager();
// $entry = $test->entryEdit($text); 
echo $test->entryDisplay($text); 