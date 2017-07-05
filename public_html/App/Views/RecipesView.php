<?php

namespace App\Views;

class RecipesView extends TemplateView
{
	public function render() 
	{
		extract($this->data);
		$page = "recipes";
		$page_title = "Recipes";
		include "templates/master.inc.php";
	}
	protected function content() 
	{
		extract($this->data);
		include "templates/recipes.inc.php";
	}
}

