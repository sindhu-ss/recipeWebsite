<?php

namespace App\Views;

class SingleRecipeView extends TemplateView
{
	public function render() 
	{
		extract($this->data);
		$page = "recipe";
		$page_title = $recipe->title;
		include "templates/master.inc.php";
	}
	protected function content() 
	{
		extract($this->data);
		include "templates/singlerecipe.inc.php";
	}
}
