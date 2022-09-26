<?php

require_once('Manager.php');

class TagManager extends Manager{


    protected function checkTagMap($entryUID){
        $db = $this->dbConnect();
        $check_tag_map = $db->prepare("SELECT tag_id FROM tag_map WHERE entry_id = :entry_id");
        $check_tag_map->bindParam('entry_id', $entryUID, PDO::PARAM_STR);
        $check_tag_map->execute();
        $existingTags = $check_tag_map->fetchAll(PDO::FETCH_ASSOC);
        return $existingTags;
    }

    protected function getTagID($tag_name){
        $db = $this->dbConnect();
        $check_tags = $db->prepare('SELECT id FROM tags WHERE tag_name = :tag_name');
        $check_tags->bindParam('tag_name',$tag_name, PDO::PARAM_STR);
        $check_tags->execute();
        return $check_tags->fetch();
    }
    

    public function getTags($entryUID){
        $db = $this->dbConnect();
        $get_tags = $db->prepare('SELECT tag_name 
                                FROM tags t 
                                JOIN tag_map tm 
                                ON t.id = tm.tag_id 
                                WHERE tm.entry_id = :entry_id');
        $get_tags->bindParam('entry_id', $entryUID, PDO::PARAM_STR);
        $get_tags->execute();
        return $get_tags->fetchAll();
    }

    public function submitTags($tag_string, $entryUID){
        $db = $this->dbConnect();

        // Check for existing Tabs
        $existingTags = $this->checkTagMap($entryUID);
        
        // array with all the inputted tags
        $tags_to_insert = explode(',' ,$tag_string);

        // if that entry already has tags (Editing Tags Feature)
        if (count($existingTags) > 0){

            $entry_tags = $db->query("SELECT tag_name
                                    FROM tags t
                                    INNER JOIN tag_map tm
                                    ON t.id = tm.tag_id");
            $existing_entry_tags = $entry_tags->fetchAll(PDO::FETCH_ASSOC);
            foreach($tags_to_insert as $tag_name){
                if (array_key_exists($tag_name, $existing_entry_tags)){
                    $tags_to_insert = array_splice($tags_to_insert, 1, $tag_name);
                }
            }
        }

        // submitting the tags
        foreach($tags_to_insert as $tag){
            // to get the tag ID
            $checkID = $this->getTagID($tag);

            if (!$checkID){
                // insert into tags table
                $req1 = $db->prepare("INSERT INTO tags
                                                (tag_name)
                                                VALUES
                                                (:tag_name)");
                $req1->bindParam('tag_name', $tag, PDO::PARAM_STR);
                $req1->execute();
            }

            $getID = $this->getTagID($tag);
            // insert into tag_map table
            $req2 = $db->prepare("INSERT INTO tag_map
                                            (entry_id
                                            , tag_id)
                                            VALUES
                                            (:entry_id
                                            , :tag_id)");
            $req2->bindParam('entry_id', $entryUID, PDO::PARAM_STR);
            $req2->bindParam('tag_id', $getID['id'], PDO::PARAM_INT);
            $req2->execute();
        }
        return;
    }
}