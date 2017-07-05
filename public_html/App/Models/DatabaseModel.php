<?php

namespace App\Models;

use PDO;

use UnexpectedValueException;
use App\Models\Exceptions\ModelNotFoundException;

abstract class DatabaseModel
{
	public $data = [];
	public $errors = [];

	protected static $columns = [];
	protected static $fakeColumns = [];

	private static $db;

	
	public function __construct($input = null)
	{
		if(static::$columns){
			foreach (static::$columns as $column) {
				$this->$column = null;
				$this->errors[$column] = null;
			}
		}

		if(static::$fakeColumns){
			foreach (static::$fakeColumns as $column) {
				$this->$column = null;
				$this->errors[$column] = null;
			}
		}
		
		

		if(is_numeric($input) && $input > 0 ){
			
			$this->find($input);
		}
		if (is_array($input)) {
			
			$this->processArray($input);
 		}
	}

	
	// static can be used anywhere.protected can be used by children but not other classes. privtae can only be used within the class itself. public can be accessed anywhere
	protected static function getDatabaseConnection()
	{
		if (! self::$db) {
			$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
			self::$db = new PDO($dsn, DB_USER, DB_PASSWORD);

			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		return self::$db;
	}

	public function processArray($input)
	{
		foreach(static::$columns as $column){
			if(isset($input[$column]))
				$this->$column = $input[$column];
		}
		foreach (static::$fakeColumns as $column) {
			if(isset($input[$column]))
				$this->$column = $input[$column];
		}
	}


	public static function all($sortcolumn = "", $asc = true, $pageNumber=null, $pageSize=null)
	{
		$models = [];

		$db = static::getDatabaseConnection();

		$query = "SELECT " .implode("," , static::$columns). " FROM " . static::$tableName;

		if($sortcolumn){
			if(! array_search($sortcolumn, static::$columns)) {
				throw new UnexpectedValueException("Property $sortcolumn not found in the columns array.");
			}
			
			$query .= " ORDER BY " .$sortcolumn;
			if($asc){
				
				$query .= " ASC";
			} else {
				
				$query .= " DESC";
			}
		}

		if($pageSize > 0 && $pageNumber > 0) {
			$firstRecord = ($pageSize * $pageNumber) - $pageSize;
			
			$query .= " LIMIT " .$firstRecord." , ".$pageSize;
		}

		$statement = $db->prepare($query);
		
		$statement->execute();

		while($record = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$model = new static();
			$model->data = $record;
			array_push($models, $model);
		}


		return $models;
		
	}
 
	public static function allBy($column, $value, $sortcolumn = "", $asc = true, $pageNumber=null, $pageSize=null)
	{
		
		$models = [];

		$db = static::getDatabaseConnection();

		$query = "SELECT " .implode("," , static::$columns). " FROM " . static::$tableName;

		if(! array_search($column, static::$columns)) {
			throw new UnexpectedValueException("Property $column is not found in the column.");
		}
	
		$query .= " WHERE $column =:value";

		
		if($sortcolumn){
			if(! array_search($sortcolumn, static::$columns)) {
				throw new UnexpectedValueException("Property $sortcolumn not found in the columns array.");
			}
			
			$query .= " ORDER BY " .$sortcolumn;
			if($asc){
			
				$query .= " ASC";
			} else {
			
				$query .= " DESC";
			}
		}

		if($pageSize > 0 && $pageNumber > 0) {
			$firstRecord = ($pageSize * $pageNumber) - $pageSize;
			
			$query .= " LIMIT " .$firstRecord." , ".$pageSize;
		}

		$statement = $db->prepare($query);
		
		$statement->bindValue(":value", $value);
		$statement->execute();


		while($record = $statement->fetch(PDO::FETCH_ASSOC)) 
		{
			$model = new static();
			$model->data = $record;
			array_push($models, $model);
		}

		return $models;
	}

	public static function count()
	{
		
		$db = static::getDatabaseConnection();
		
		$query = "SELECT count(id) FROM " .static::$tableName;

		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchColumn();
		return $result;
	}


	public function find ($id)
	{
		$db = static::getDatabaseConnection();
		$query = "SELECT " .implode("," , static::$columns). " FROM " . static::$tableName . 
			" WHERE id = :id ";
		$statement = $db->prepare($query);
		$statement->bindValue(":id", $id);
		$statement->execute();

		
		$record = $statement->fetch(PDO::FETCH_ASSOC);

		if (! $record){
			throw new ModelNotFoundException();
		}
			// extract data from record.
			$this->data = $record;
	}

	public static function findBy($column, $value)
	{
		$db = static::getDatabaseConnection();

		$query = "SELECT " .implode("," , static::$columns). " FROM " . static::$tableName . 
			" WHERE " . $column . " = :value";

		$statement = $db->prepare($query);
		
		$statement->bindValue(':value', $value);
		$statement->execute();

		$record = $statement->fetch(PDO::FETCH_ASSOC);

		if(! $record){
		
			throw new ModelNotFoundException();

		}

		$obj = new static;
		$obj->data = $record;
		return $obj;
	}
	
	public function save()
	{

		if($this->id > 0){
			$this->update();
		} else {
			$this->insert();
		}
	}

	
	public function insert()
	{

		$db = static::getDatabaseConnection();

		$columns = static::$columns;

		unset($columns[array_search('id', $columns)]);

		$query = "INSERT INTO " . static::$tableName . 
			" (". implode(", ", $columns) . ")" .
			" VALUES (";

		$insertcols = [];
		foreach ($columns as $column) {
			array_push($insertcols, ":" . $column);
		}

		$query .= implode(", ", $insertcols);
		$query .= ")";
		
		$statement = $db->prepare($query);


		foreach ($columns as $column) {
			if ($column === "password") {
				$this->$column = password_hash($this->$column, PASSWORD_DEFAULT);
			}
			$statement->bindValue(":" . $column, $this->$column);
		}
		
		$statement->execute();

		$this->id =$db->lastInsertId();
	}

	public function update()
	{

		$db = static::getDatabaseConnection();

		$columns = static::$columns;
		
		unset($columns[array_search('id', $columns)]);
		
		$query = "UPDATE " . static::$tableName . " SET ";

		$updatecols = [];

		foreach ($columns as $column) {
			array_push($updatecols, $column . "=:" . $column);
		}

		$query .= implode(", ", $updatecols);
		
		
		$query .= " WHERE id =:id";

		$statement = $db->prepare($query);

		foreach (static::$columns as $column) {
			$statement->bindValue(":".$column, $this->$column);
		}
		
		$statement->execute();

	}

	public function isValid()
	{

		$valid = true;
		foreach (static::$validationRules as $column => $rules) {
			$this->errors[$column] = null;
			$rules = explode(",", $rules);
			foreach ($rules as $rule) {
				if(strstr($rule, ":")){
					$rule = explode(":", $rule);
					$value = $rule[1];
					$rule = $rule[0];
				}
				switch ($rule) {
					case 'minlength':
						// var_dump($this->$column);
						if(strlen($this->$column) < $value){
							$valid = false;
							$this->errors[$column] = "Must be at least $value characters long.";
						}
						break;
					case 'maxlength':
						if(strlen($this->$column) > $value){
							$valid = false;
							$this->errors[$column] = "Must be no more than $value characters long.";
						}
						break;
					case 'numeric':
						if(! is_numeric($this->$column)){
							$valid = false;
							$this->errors[$column] = "Must be a number.";
						}
						break;
					case 'email':
						if(! filter_var($this->$column, FILTER_VALIDATE_EMAIL)){
							$valid = false;
							$this->errors[$column] = "Must be a valid email address.";
						}
						break;
					case 'match':
						if( $this->$column !== $this->$value){
							$valid = false;
							$this->errors[$column] = "Must match with the $value field.";
						}
						break;
					case 'unique':
						try {
							$record = $value::findBy($column, $this->$column);
						} catch (ModelNotFoundException $e) {
							break;
						}
						$valid = false;
						$this->errors[$column] = "This email is already in use";
						break;
					case 'exists':
						try {
							$record = new $value($this->$column);
						} catch (ModelNotFoundException $e) {
							$valid = false;
							$this->errors[$column] = "This value does not exist.";
							break;
						}
						
				}
			}
			
		}
		return $valid;
	}

	public static function destroy($id)
	{
		$db = static::getDatabaseConnection();
		$query = "DELETE FROM " . static::$tableName . " WHERE id= :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
	}

	public function __get($name)
	{
		if (in_array($name, static::$columns) || in_array($name, static::$fakeColumns)) {
			
           return $this->data[$name];
         }
        throw new UnexpectedValueException("Property '$name' not found in the data variable.");
    }
    
	public function __set($name, $value)
	{
		if (! in_array($name, static::$columns) && ! in_array($name, static::$fakeColumns)) {
            throw new UnexpectedValueException("Property '$name' not found in the data variable.");
          }
        $this->data[$name] = $value;
 	}

}





   
