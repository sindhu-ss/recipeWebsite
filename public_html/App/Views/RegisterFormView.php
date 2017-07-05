<?php 

namespace App\Views;

class RegisterFormView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "auth.register";
		$page_title = "Sign up";
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/register.inc.php";
	}
}