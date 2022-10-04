<?php

require_once('Manager.php');

class filterManager extends Manager 
{

    protected function getAllEntries($userUID)
    {
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
                            WHERE e.user_uid = :uid AND e.is_active = 1
                            GROUP BY last_edited DESC
                            ');
        $req->bindParam('uid',$userUID,PDO::PARAM_STR);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filterEntries($userUID, $filters, $values){
        
        // Array of Filters
        $filters = explode(',',$filters);
        
        // Array of Filter Values to filter entries by
        $values = explode(',',$values);

        // All Entries
        $allEntries = $this->getAllEntries($userUID);

        // return array
        $filteredED = [];

        // echoPre($values);

        $FilteredEntriesByValue = [];
        foreach($values as $value){
            array_push($FilteredEntriesByValue,
                array_filter($allEntries,function($el) use ($filters, $value){
                    foreach($filters as $filter){
                        // if there's no filter keyword in the return string => array_filter removes the entry
                        if (stripos($el[$value],$filter) === false){
                            return false;
                        };
                    };
                    return true;
                })
            );
        }
        // Array with all entries filtered by filters and values
        $filteredEntries = array_merge_recursive(...$FilteredEntriesByValue);

        foreach($filteredEntries as $filteredEntry){
            $monthYearKey = $filteredEntry['month'] . " " . $filteredEntry['year'];
            if (array_key_exists($monthYearKey, $filteredED)){
                // push the entry into the key
                $filteredED[$monthYearKey][] = $filteredEntry;
            } else {
                // create the key in the array & push the entry into the key
                $filteredED[$monthYearKey] = [];
                $filteredED[$monthYearKey][] = $filteredEntry;
            }
        }
        return $filteredED;
    }


}