<?php

namespace App\Controllers;

use App\Views\RegisterFormView;
use App\Views\LoginFormView;
use App\Models\User;


class AuthenticationController extends Controller
{
	public function register()
	{
		$user = $this->getUserFormData();
		$view = new RegisterFormView(compact('user'));
		$view->render();
	}
	public function store()
	{
		$_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
		$_POST['password'] = htmlspecialchars($_POST['password'], ENT_QUOTES);
		$_POST['password2'] = htmlspecialchars($_POST['password2'], ENT_QUOTES);
		
		$user = new User($_POST);

		if(! $user->isValid()){
			$_SESSION['user.form'] = $user;
			header("Location: ?page=register");
			exit();
		}
		$user->save();
		header("Location: ?page=login");
	}
	public function login()
	{
		$user = $this->getUserFormData();

		$error = isset($_GET['error']) ? $_GET['error'] : null;

		$view = new LoginFormView(compact('user', 'error'));
		$view->render();
	}

	
	public function attempt()
	{
		$_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
		$_POST['password'] = htmlspecialchars($_POST['password'], ENT_QUOTES);

		if(static::$auth->attempt($_POST['email'],$_POST['password'])){
			
			header("Location: ./");
			exit();
		}
		header("Location: ?page=login&error=true");
		exit();
	}

	public function logout()
	{
		 static::$auth->logout();
		 header("Location: ?page=home");
		 exit();
	}

	protected function getUserFormData($id = null)
	{
		if(isset($_SESSION['user.form'])){
			$user = $_SESSION['user.form'];
			unset($_SESSION['user.form']);
		} else {
			$user = new User($id);
		}
		return $user;
	}

}