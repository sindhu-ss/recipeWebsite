<?php 

namespace App\Controllers;

class Controller 
{
	#object of Authentication Service class
	protected static $auth;

	public static function registerAuthenticationService($auth)
	{
		self::$auth = $auth;
	}
}