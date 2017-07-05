<?php

namespace App\Controllers;

use App\Views\ThankyouEmailView;
use App\Views\NewsletterSuccessView;


class RequestController 
{
	private $requestform = [];

	public function __construct()
	{
		$this->requestform = [
							'error' =>[]
						];
	}

	public function resetSessionData() 
	{
		$_SESSION['requestformerror'] = NULL;
		$_SESSION['requestform'] = NULL;
		
	}
	public function getRecipeRequestFormData()
	{
		
		$expectedVar = ['name', 'email', 'reciperequest'];

		//passing each value through the foreach loop.
		foreach ($expectedVar as $variable) {
			
			
			$this->requestform['error'][$variable]= "";

			if(isset($_POST[$variable])) {
				$this->requestform[$variable] = $_POST[$variable];
				
			} else {
				$this->requestform[$variable] = "";
			}
		
		}
		
	}
	public function isFormValid()
	{
		$valid = true;

		if(strlen($this->requestform['name']) == 0) {
			$this->requestform['error']['name'] = "Enter your name";
			$valid = false;
		}

		
		if (! filter_var($this->requestform['email'], FILTER_VALIDATE_EMAIL)) {
			$this->requestform['error']['email'] = "Enter a valid email address";
			$valid = false;
		} 

		if(strlen($this->requestform['reciperequest']) == 0) {
			$this->requestform['error']['reciperequest'] = "Make a Recipe Request";
			$valid = false;
		} 
		return $valid;
	}
	

	public function show()
	{
		$this->resetSessionData();

		$this->getRecipeRequestFormData();

		if (! $this->isFormValid() ) {
		
			$_SESSION['requestform'] = $this->requestform;
			header("Location: ?page=recipes#request");
			return;
		}

		$view = new NewsletterSuccessView();
		$view->render();

		$suggesterEmail = new ThankyouEmailView($this->requestform);
		$suggesterEmail->render();
		
	}

}
