<?php 

namespace App\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{

public function create()
	{
		$input = $_POST;

		
		$input['user_id'] = static::$auth->user()->id;
		$input['comment'] = htmlspecialchars($input['comment'], ENT_QUOTES);
		
		$newcomment = new Comment($input);
		

		if(! $newcomment->isValid()){
			
			$_SESSION['comment.form'] = $newcomment;
			
			header("Location:?page=recipe&id=" . $newcomment->recipe_id . "#comment");
			exit();
		}
		$newcomment->save();

		header("Location: ?page=recipe&id=" . $newcomment->recipe_id . "#comment");


	}

}
