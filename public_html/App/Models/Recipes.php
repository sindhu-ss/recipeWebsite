<?php

namespace App\Models;

use PDO;
use finfo;
use Intervention\Image\ImageManagerStatic as Image;

class Recipes extends DatabaseModel
{
	protected static $tableName = "recipes";
	protected static $columns = ['id', 'title','description', 'ingredients', 'poster', 'date_created', 'category'];
	protected static $fakeColumns = ['tags'];
	protected static $validationRules = [
					"title"       => "minlength:1",
					"ingredients" => "minlength:10"

	];
	public function comments()
	{
		$result = Comment::allBy('recipe_id', $this->id);
		return $result;
	}
	public function getTags()
	{
		$models = [];

		$db = static::getDatabaseConnection();
		$query = " SELECT id, tag FROM tags ";
		$query .= " JOIN recipes_tag ON id = tag_id ";
		$query .= " WHERE recipe_id =:id";

		$statement = $db->prepare($query);
		// var_dump($statement);
		$statement->bindValue(":id", $this->id);
		$statement->execute();

		while($record = $statement->fetch(PDO::FETCH_ASSOC)){
			$model = new Tags();
			$model->data = $record;
			array_push($models, $model);
		}

		return $models;
	}
	public function loadTags()
	{
		$tags = $this->getTags();
		$taglist = [];
		foreach ($tags as $tag) {
			array_push($taglist, $tag->tag);
		}
		// var_dump($taglist);
		$this->tags = implode(",", $taglist);
	}
	public function saveTags()
	{

		$tags = explode(",", $this->tags);
		foreach ($tags as $tag) {
			$tag = trim($tag);
		}
		$db = static::getDatabaseConnection();

		$db->beginTransaction();

		try {
			
			$this->addNewTags($db, $tags);
			$tagsIds = $this->getTagIds($db, $tags);
			$this->deleteAllTagsFromRecipes($db);
			$this->insertTagsForRecipes($db, $tagsIds);

			$db->commit();

		} catch (Exception $e){
			$db->rollback();
			throw $e;	
		}
	}
	private function addNewTags($db, $tags)
	{
		$query = "INSERT IGNORE INTO tags (tag) VALUES ";

		$tagvalues = [];
		for ($i=0; $i < count($tags); $i++) { 
			array_push($tagvalues, "(:tag{$i})");
		}
		$query .= implode(",", $tagvalues);
		$statement = $db->prepare($query);
		// var_dump($query);

		for ($i=0; $i < count($tags); $i++) { 
			$statement->bindValue(":tag{$i}", $tags[$i]);
		}
		$statement->execute();
	}
	private function getTagIds($db, $tags)
	{
		$query = "SELECT id FROM tags WHERE ";
		$tagvalues = [];
		for ($i=0; $i < count($tags); $i++) { 
			array_push($tagvalues, "tag = :tag{$i}");
		}
		$query .= implode(" OR ", $tagvalues);
		$statement = $db->prepare($query);
		// var_dump($query);
		for ($i=0; $i < count($tags); $i++) { 
			$statement->bindValue(":tag{$i}", $tags[$i]);
		}
		$statement->execute();

		$record = $statement->fetchAll(PDO::FETCH_COLUMN);
		return $record;
	}
	private function insertTagsForRecipes($db, $tagsIds)
	{
		$query = "INSERT IGNORE INTO recipes_tag (recipe_id, tag_id) VALUES ";

		$tagvalues = [];
		for ($i=0; $i < count($tagsIds); $i++) { 
			array_push($tagvalues, "(:recipe_id{$i}, :tag_id{$i})");
		}
		$query .= implode(",", $tagvalues);
		$statement = $db->prepare($query);
		for ($i=0; $i < count($tagsIds); $i++) { 
			$statement->bindValue(":recipe_id{$i}", $this->id);
			$statement->bindValue(":tag_id{$i}", $tagsIds[$i]);
		}
		$statement->execute();
	}
	private function deleteAllTagsFromRecipes($db)
	{
		$query = "DELETE FROM recipes_tag WHERE 	recipe_id= :recipe_id";
		$statement = $db->prepare($query);
		// var_dump($statement);
		$statement->bindValue(":recipe_id", $this->id);
		$statement->execute();
	}
	public function savePoster($filename)
	{
		
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		// return file type of uploaded image
		$mime = $finfo->file($filename);
		 // var_dump($mime);

		// extentsions for file type. creating extensions
		$extentsions = [
			'image/jpg'  => '.jpg',
			'image/jpeg' => '.jpeg',
			'image/png'  => '.png',
			'image/gif'  => '.gif'
		];
		if(isset($extentsions[$mime])){
			$extentsion = $extentsions[$mime];
		} else {
			$extentsion = '.jpg';
		}
		$newFileName = uniqid() . $extentsion;

		$folder = "./images/poster/originals";

		if( ! is_dir($folder)){
			mkdir($folder, 0777, true);
		}
		$destination = $folder . "/" . $newFileName;
	
		move_uploaded_file($filename, $destination);

		$this->poster = $newFileName;
		
		if (! is_dir("./images/poster/300h/")){
			mkdir("./images/poster/300h/" , 0777, true);
		}
		
		$img = Image::make($destination);
		
		$img->fit(300,300);
		
		$img->save("./images/poster/300h/" . $newFileName);
		
		if (! is_dir("./images/poster/100h/")){
			mkdir("./images/poster/100h/" , 0777, true);
		}

		$img = Image::make($destination);
		$img->fit(600,600);
		$img->save("./images/poster/100h/" . $newFileName);
		
		
	}
	public static function search($searchQuery)
	{
		$models = [];

		$db = static::getDatabaseConnection();

		// var_dump($searchQuery);
		$query = "SET @searchterm = :searchQuery ";
		$statement = $db->prepare($query);
		// var_dump($statement);
		$statement->bindValue(":searchQuery", $searchQuery);
		$result = $statement->execute();
		// var_dump($result);

		$query = " SELECT recipes.id, title, description, taglist, 
						 -- search against search term. * 2 gives search preference to title results
                        MATCH(title) AGAINST(@searchterm) * 2 AS score_title, 
                        MATCH(description) AGAINST(@searchterm) AS score_description,
                        MATCH(taglist) AGAINST(@searchterm IN BOOLEAN MODE) * 1.5 AS score_tag
                    FROM recipes
                    LEFT JOIN (
                        SELECT recipe_id, GROUP_CONCAT(tag SEPARATOR ' ') AS taglist FROM tags
                        RIGHT JOIN recipes_tag ON recipes_tag.tag_id = id
                        GROUP BY recipe_id) AS tags ON recipes.id = recipe_id
                    WHERE 
                        MATCH(title) AGAINST(@searchterm) OR
                        MATCH(description) AGAINST(@searchterm) OR
                        MATCH(taglist) AGAINST(@searchterm IN BOOLEAN MODE)
                        -- order that results are displayed
                        ORDER BY (score_title + score_description + score_tag) DESC";

		$statement = $db->prepare($query);
		// var_dump($statement);
		$record = $statement->execute();
		// var_dump($record);

		while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
			$model = new Recipes();
			$model->data = $record;
			array_push($models, $model);
		}
		return $models;
	}

	
	
}


   
