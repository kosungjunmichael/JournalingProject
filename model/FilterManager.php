<?php

require_once('Manager.php');

class filterManager extends Manager 
{

    public function filterEntries($userUID, $filters, $values, $group){
        
        // Array of Filters
        $filters = explode(',',$filters);
        
        // Array of Filter Values to filter entries by
        $values = explode(',',$values);
        
        // All Entries
        $allEntries = $this->getEnt("allEntries", $userUID);

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
        // $filteredEntries = array_merge_recursive(...$FilteredEntriesByValue);
        $filteredEntries = array_merge_recursive(...$FilteredEntriesByValue);
        // TODO: filter duplicate entries
        $checkArr = [];
        foreach($filteredEntries as $rawEntry){
            array_push($checkArr,$rawEntry['u_id']);
        }
            
        
            foreach($checkArr as $check){
                if (count($check)>1){
                    array_splice($filteredEntries,array_search($check,$checkArr),1);
                }
            }


        echoPre($filteredEntries);


        foreach($filteredEntries as $filteredEntry){
            if (strtolower($group) === "monthly") {
                $monthYearKey = $filteredEntry['month'] . " " . $filteredEntry['year'];
                if (array_key_exists($monthYearKey, $filteredED)){
                    // push the entry into the key
                    $filteredED[$monthYearKey][] = $filteredEntry;
                } else {
                    // create the key in the array & push the entry into the key
                    $filteredED[$monthYearKey] = [];
                    $filteredED[$monthYearKey][] = $filteredEntry;
                }
            } else if (strtolower($group) === "weekly"){
                // current year
                $thisYear = date("Y");
                // current month
                $thisMonth = date("F");
                // current week number for the year
                $thisWeek = date("W");

                // for current year & month & weeknumber
                if (
                    $filteredEntry["year"] == $thisYear AND
                    $filteredEntry["month"] == $thisMonth AND
                    $filteredEntry["week"] == $thisWeek
                ) {
                    // check if the keyname exists in the $filteredED
                    if (array_key_exists($filteredEntry["dayname"], $filteredED)) {
                        // push the entryContent into the key
                        $filteredED[$filteredEntry["dayname"]][]= $filteredEntry;
                    } else {
                        // create the array in the key & push the filteredEntry into the key
                        $filteredED[$filteredEntry["dayname"]] = [];
                        $filteredED[$filteredEntry["dayname"]][] = $filteredEntry;
                    }
                }
            }
        }
        return $filteredED;
    }

}