<?php

namespace App\Views;

class SearchResultsView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "searchrecipes";
		$page_title = "Search";
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/searchresults.inc.php";
	}
}