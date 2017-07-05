<?php 

namespace App\Views;

class RecipeCreateView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "recipe.create";
		$page_title = "Add New Recipe";
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/recipecreate.inc.php";
	}
}