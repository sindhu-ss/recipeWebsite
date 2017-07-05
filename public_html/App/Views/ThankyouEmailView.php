<?php

namespace App\Views;

class ThankyouEmailView extends EmailView
{

	public function render()
	{
		$this->sendEmail("templates/thankyouemail.inc.php");
	}
}