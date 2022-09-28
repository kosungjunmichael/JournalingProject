<?php 

require_once('Manager.php');

class filterManager extends Manager {

    public function filterEntries($userUID, $filters){
      $db = $this->dbConnect();

      // current year
      $thisYear = date('Y');
      
      $entriesDisplay = array();

      $filters = explode(',',$filters);
      foreach($filters as $filter){
        $thisFilter = "%".$filter."%";
          $req = $db->prepare('SELECT e.u_id
            , e.title
            , e.text_content
            , e.last_edited
            , DAYNAME(e.last_edited) as dayname
            , WEEK(e.last_edited) as week
            , DAY(e.last_edited) as day
            , MONTHNAME(e.last_edited) as month
            , YEAR(e.last_edited) as year
            , e.date_created
            , e.location
            , GROUP_CONCAT(t.tag_name) as tags
            FROM entries e
            LEFT JOIN tag_map tm ON e.u_id = tm.entry_id
            LEFT JOIN tags t ON t.id = tm.tag_id
            WHERE user_uid = :uid
            GROUP BY last_edited DESC
            HAVING tags LIKE :filt
            ');
            $req->bindParam('uid',$userUID,PDO::PARAM_STR);
            $req->bindParam('filt',$thisFilter,PDO::PARAM_STR);
            $req->execute();
            while ($entryContent = $req->fetch(PDO::FETCH_ASSOC)) {
                  // for current year
                  if ($entryContent['year'] == $thisYear) {
                      // check if the keyname exists in the $entriesDisplay
                      if (array_key_exists($entryContent['month'], $entriesDisplay)) {
                          // push the entryContent into the key
                          array_push($entriesDisplay[$entryContent['month']], $entryContent);
                      } else {
                          // create the array in the key & push the entryContent into the key
                          $entriesDisplay[$entryContent['month']] = array();
                          array_push($entriesDisplay[$entryContent['month']], $entryContent);
                      }
                  }
            }
            return $entriesDisplay;
        }
        $req->closeCursor();
    }

}