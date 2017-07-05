<?php 

namespace App\Views;

class LoginFormView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "auth.login";
		$page_title = "Login";
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/login.inc.php";
	}
}