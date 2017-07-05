<?php 

date_default_timezone_set('Pacific/Auckland');

error_reporting(E_ALL);

require '../recipeWebsite-config.inc.php';

require 'vendor/autoload.php';

session_start();

session_regenerate_id(true);

$auth = new App\Service\AuthenticationService();

App\Views\View::registerAuthenticationService($auth);
App\Controllers\Controller::registerAuthenticationService($auth);

require "routes.php";


