<?php

namespace App\Views;

class HomeView extends TemplateView
{
	public function render() 
	{

		extract($this->data);

		$page = "index";
		// var_dump($newsletter);
		$page_title = "Maria's Kitchen";
		include "templates/master.inc.php";
	}
	protected function content() 
	{
		extract($this->data);
		include "templates/index.inc.php";
	}
}
