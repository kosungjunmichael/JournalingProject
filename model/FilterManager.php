<?php

require_once('Manager.php');

class filterManager extends Manager 
{

    public function filterEntries($userUID, $filters, $values){
        
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