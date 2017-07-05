<?php

namespace App\Controllers;
use App\Models\Recipes;
use App\Views\SearchResultsView;

class SearchController extends Controller
{
	function search() 
	{
		if(! isset($_GET['q'])){
			$q = "";
		} else {
			$q = $_GET['q'];
		}
		$recipes = Recipes::search($q);

		$view = new SearchResultsView(compact('recipes', 'q'));
		$view->render();
	}
}