<?php

require_once('Manager.php');

class filterManager extends Manager {

    protected function getAllEntries($userUID){
        $db = $this->dbConnect();

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
                            ');
        $req->bindParam('uid',$userUID,PDO::PARAM_STR);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function filterEntriesByTag($userUID, $filters){
        //   return $filters;
        
        // Array of Filters
        $filters = explode(',',$filters);

        // All Entries
        $eachEntry = $this->getAllEntries($userUID);

        // return array
        $entriesDisplay = [];

        foreach($filters as $filter){
            foreach($eachEntry as $entry){
                if (str_contains($entry['tags'], $filter)){
                    $monthYearKey = $entry['month'] . " " . $entry['year'];
                    if (array_key_exists($monthYearKey, $entriesDisplay)) {
                        // push the entry into the key
                        $entriesDisplay[$monthYearKey][] = $entry;
                    } else {
                        // create the key in the array & push the entry into the key
                        $entriesDisplay[$monthYearKey] = [];
                        $entriesDisplay[$monthYearKey][] = $entry;
                    }
                }
            }
            return $entriesDisplay;
        }
    }

    
}