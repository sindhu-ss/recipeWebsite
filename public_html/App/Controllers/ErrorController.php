<?php

namespace App\Controllers;

use App\Views\Error404View;
use App\Views\Error401View;

class ErrorController extends Controller
{
	public function error401()
	{
		$view = new Error401View();
		$view->render();
	}
	public function error404()
	{
		$view = new Error404View();
		$view->render();
	}


}