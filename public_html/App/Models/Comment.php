<?php

namespace App\Models;


class Comment extends DatabaseModel
{
	protected static $columns = ['id', 'user_id', 'recipe_id', 'comment', 'created'];

	protected static $tableName = "comments";

	protected static $validationRules = [
				'user_id'  => 'numeric,exists:\App\Models\User',
				'recipe_id' => 'numeric,exists:\App\Models\Recipes',
				'comment'  => 'minlength:10,maxlength:1600'
	];
	
	public function user()
	{
		return new User($this->user_id);
	}
}


   
