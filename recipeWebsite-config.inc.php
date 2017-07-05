<?php

if (stristr($_SERVER['HTTP_HOST'], "recipewebsite.co.nz")) {



	define("DEV_ENVIRONMENT", false);
	// local development phase

	// sets variable in php.ini file
	ini_set('display_erros', false);
	ini_set('log_erros', 1);
	// current directory(getcwd) go to this path (string)
	ini_set('error_log', getcwd() . "/php-error.log");

	define("MAILGUN_KEY", '');
	define("MAILGUN_DOMAIN", '');

	define("DB_HOST", '');
	define("DB_NAME", '');
	define("DB_USER", '');
	define("DB_PASSWORD", '');

} else {
	// local development phase
	define("DEV_ENVIRONMENT", true);

	// sets variable in php.ini file
	ini_set('display_erros', true);
	ini_set('log_erros', 1);
	// current directory(getcwd) go to this path (string)
	ini_set('error_log', getcwd() . "/php-error.log");

	define("MAILGUN_KEY", '');
	define("MAILGUN_DOMAIN", '');

	define("DB_HOST", 'localhost');
	define("DB_NAME", 'recipe');
	define("DB_USER", 'root');
	define("DB_PASSWORD", '');

}


