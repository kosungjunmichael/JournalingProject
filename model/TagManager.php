<?php

require_once "Manager.php";

class TagManager extends Manager 
{
	protected function getTagID($tag_name)
	{
		$db = $this->dbConnect();
		$check_tags = $db->prepare('SELECT id
                                    FROM tags
                                    WHERE tag_name = :tag_name
                                    ');
		$check_tags->bindParam("tag_name", $tag_name, PDO::PARAM_STR);
		$check_tags->execute();
		return $check_tags->fetch();
	}

	public function getTags($entryUID)
	{
		$db = $this->dbConnect();
		$get_tags = $db->prepare('SELECT tag_name
                                FROM tags t
                                JOIN tag_map tm
                                ON t.id = tm.tag_id
                                WHERE tm.entry_id = :entry_id
                                ');
		$get_tags->bindParam("entry_id", $entryUID, PDO::PARAM_STR);
		$get_tags->execute();
		return $get_tags->fetchAll();
	}

	public function submitTags($tag_string, $entryUID)
	{
		$db = $this->dbConnect();

		// Check for existing Tabs
		$existingTags = $this->getTags($entryUID);

		// array with all the inputted tags
		$tags_to_insert = explode(",", $tag_string);

		// TODO: use for Editing Tags Feature
		// if that entry already has tags
		if (count($existingTags) > 0) {
			foreach ($tags_to_insert as $tag_name) {
				if (array_key_exists($tag_name, $existingTags)) {
					$tags_to_insert = array_splice($tags_to_insert, 1, $tag_name);
				}
			}
		}

		// submitting the tags
		foreach ($tags_to_insert as $tag) {
			// check if the tag already exists
			$checkID = $this->getTagID($tag);

			// if tag doesn't exist
			if (!$checkID) {
				// insert into tags table
				$req1 = $db->prepare("INSERT INTO tags (tag_name)
                                                VALUES (?)
                                    ");
				$req1->bindParam(1, $tag, PDO::PARAM_STR);
				$req1->execute();
			}
			// get the tag IDs after submitting into table
			$getID = $this->getTagID($tag);
			// insert into tag_map table
			$req2 = $db->prepare("INSERT INTO tag_map
                                            (entry_id, tag_id)
                                            VALUES
                                            (:entry_id, :tag_id)
                                ");
			$req2->bindParam("entry_id", $entryUID, PDO::PARAM_STR);
			$req2->bindParam("tag_id", $getID["id"], PDO::PARAM_INT);
			$req2->execute();
		}
		return;
	}
}
