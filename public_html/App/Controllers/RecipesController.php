<?php

namespace App\Controllers;

use App\Views\RecipesView;
use App\Views\SingleRecipeView;
use App\Views\RecipeCreateView;
use App\Models\Recipes;
use App\Models\Comment;

class RecipesController extends Controller
{
	public function show()
	{
		$recmain = Recipes::all("date_created", false, 1, 1);
		$smoothies = Recipes::allBy("category", "smoothie", "category", false);
		$snacks = Recipes::allBy("category", "snack", "category", true);
		$desserts = Recipes::allBy("category", "dessert", "category", false);
		$glutenfree = Recipes::allBy("category", "glutenfree", "category");
		$vegan = Recipes::allBy("category", "vegan", "category");
		$requestform = $this->getRequestRecipeFormData();

		$view = new RecipesView(compact('recmain', 'smoothies', 'snacks', 'desserts', 'glutenfree', 'vegan', 'requestform'));
		$view->render();
	}
	public function singlepage()
	{
		$recipe = new Recipes((int)$_GET['id']);
		$newcomment = $this->getCommentFormData();
		$comments = $recipe->comments();
		$tags = $recipe->getTags();

		$view = new SingleRecipeView(compact('recipe', 'newcomment', 'comments', 'tags'));
		$view->render();
	}

	public function create()
	{
		static::$auth->mustBeAdmin();
		$recipe = $this->getFormData();
		$view = new RecipeCreateView(['recipe' => $recipe]);
		$view->render();
	}
	public function store()
	{
		static::$auth->mustBeAdmin();

		$recipe = new Recipes($_POST);

		if(is_array($recipe->tags)){
			$recipe->tags = implode(",", $recipe->tags);
		}

		if(! $recipe->isValid()){
			$_SESSION['recipe.create'] = $recipe;
			header("Location: ?page=recipe.create");
			exit();
		}

		if($_FILES['poster']['error'] === UPLOAD_ERR_OK){
			$recipe->savePoster($_FILES['poster']['tmp_name']);
		}

		$recipe->save();
		$recipe->saveTags();

		header("Location: ?page=recipe&id=" . $recipe->id);
	}
	public function edit()
	{

		static::$auth->mustBeAdmin();
		$recipe = $this->getFormData($_GET['id']);
		$recipe->loadTags();

		$view = new RecipeCreateView(compact('recipe', 'tags'));
		$view->render();
	}
	public function update()
	{
		
		static::$auth->mustBeAdmin();
		
		$recipe = new Recipes($_POST['id']);
		$recipe->processArray($_POST);

		if(is_array($recipe->tags)){
			$recipe->tags = implode(",", $recipe->tags);
		}
		
		if(! $recipe->isValid()){
			$_SESSION['recipe.create'] = $recipe;
			header("Location: ?page=recipe.edit&id=".$_POST['id']);
			exit();
		}

		if($_FILES['poster']['error'] === UPLOAD_ERR_OK){
			$recipe->savePoster($_FILES['poster']['tmp_name']);
		} else if(isset($_POST['removeImage']) && $_POST['removeImage'] === "true") {
			$recipe->poster = null;
		}

		$recipe->save();

		$recipe->saveTags();
		header("Location: ?page=recipe&id=" . $recipe->id);
	}
	public function destroy()
	{
		static::$auth->mustBeAdmin();
		Recipes::destroy($_POST['id']);
		header("Location: ?page=recipes");
	}

	public function getFormData($id = null){
		if(isset($_SESSION['recipe.create'])){
			$recipe = $_SESSION['recipe.create'];
			unset($_SESSION['recipe.create']);
		} else {
		
			$recipe = new Recipes((int)$id);
		}

		return $recipe;
	}
	public function getCommentFormData($id = null){
		if(isset($_SESSION['comment.form'])){
			$newcomment = $_SESSION['comment.form'];
			unset($_SESSION['comment.form']);
		} else {
			$newcomment = new Comment((int)$id);
		}
		return $newcomment;
	}
	public function getRequestRecipeFormData()
	{
		
		if(isset($_SESSION['requestform'])){
			$requestform = $_SESSION['requestform'];

		} else {
			$requestform = [
				'name' => "",
				'email' => "",
				'reciperequest' => "",
				'error' => [
					'name' => "",
					'email' => "",
					'reciperequest' => ""
				]
			];
		}
		return $requestform;
	}
}
	