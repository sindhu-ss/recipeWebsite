<?php

namespace App\Controllers;

use App\Models\Exceptions\ModelNotFoundException;


$page = isset($_GET['page']) ? $_GET['page'] : 'home';

try {

	switch ($page) {
	case 'home':

		$controller = new HomeController();
		$controller->show();

		break;


	case 'newsletter':

		$controller = new NewsletterController();
		$controller->show();
		
		break;


	case 'request':

		$controller = new RequestController();
		$controller->show();

		break;


	case 'register':

		$controller = new AuthenticationController();
		$controller->register();

		break;


	case 'auth.store':

		$controller = new AuthenticationController();
		$controller->store();

		break;


	case 'login':

		$controller = new AuthenticationController();
		$controller->login();

		break;


	case 'auth.attempt':

		$controller = new AuthenticationController();
		$controller->attempt();

		break;


	case 'logout':

		$controller = new AuthenticationController();
		$controller->logout();

		break;


	case 'recipes':

		$controller = new RecipesController();
		$controller->show();

		break;


	case 'recipe':

		$controller = new RecipesController();
		$controller->singlepage();

		break;

	case 'recipe.edit':

		$controller = new RecipesController();
		$controller->edit();

		break;


	case 'recipe.create':

		$controller = new RecipesController();
		$controller->create();

		break;

	case 'recipe.update':
		
		$controller = new RecipesController();
		$controller->update();

		break;

	case 'recipe.store':
		
		$controller = new RecipesController();
		$controller->store();

		break;

	case 'recipe.destroy':
		
		$controller = new RecipesController();
		$controller->destroy();

		break;


	case 'comment.create':

		$controller = new CommentController();
		$controller->create();

		break;	


	case "search":

		$controller = new SearchController();
		$controller->search();

		break;


	default:
		$controller = new ErrorController();
		$controller->error404();
		break;
}

} catch (ModelNotFoundException $e)
{
	$controller = new ErrorController();
	$controller->error404();
}


