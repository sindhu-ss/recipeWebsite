<?php

namespace App\Views;

class NewsletterSuccessView extends TemplateView
{
	public function render() 
	{
		extract($this->data);
		$page = "success";
		$page_title = "Thank-you!";
		include "templates/master.inc.php";
	}
	protected function content() 
	{
		extract($this->data);
		include "templates/newslettersuccess.inc.php";
	}
}