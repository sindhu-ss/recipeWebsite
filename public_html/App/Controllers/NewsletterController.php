<?php

namespace App\Controllers;

use App\Views\ThankyouEmailView;
use App\Views\NewsletterSuccessView;


class NewsletterController
{
	private $newsletter = [];

	public function __construct()
	{
		$this->newsletter = [
							'error' =>[]
						];
	}

	public function resetSessionData() 
	{
		// resetting variables. Clear form otherwise input from user stays in form field.
		$_SESSION['newslettererror'] = NULL;
		$_SESSION['newsletter'] = NULL;
		
	}
	public function getFormData()
	{
		
		$expectedVar = ['name', 'email'];

		//passing each value through the foreach loop.
		foreach ($expectedVar as $variable) {

			$this->newsletter['error'][$variable]= "";

			if(isset($_POST[$variable])) {
				$this->newsletter[$variable] = $_POST[$variable];
				
			} else {
				$this->newsletter[$variable] = "";
			}
		
		}
		
	}
	public function isFormValid()
	{
		$valid = true;

		if(strlen($this->newsletter['name']) == 0) {
			$this->newsletter['error']['name'] = "Enter your name";
			$valid = false;
		}
		
		if (! filter_var($this->newsletter['email'], FILTER_VALIDATE_EMAIL)) {
			$this->newsletter['error']['email'] = "Enter a valid email address";
			$valid = false;
		}  
		return $valid;
	}
	

	public function show()
	{

		$this->resetSessionData();

		$this->getFormData();

		if (! $this->isFormValid() ) {

			
			$_SESSION['newsletter'] = $this->newsletter;
			header("Location:./#newsletter");
			return;
		}

		$view = new NewsletterSuccessView();
		$view->render();

		$suggesterEmail = new ThankyouEmailView($this->newsletter);
		$suggesterEmail->render();
		
	}

}


   
