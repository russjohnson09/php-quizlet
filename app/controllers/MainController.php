<?php

class MainController extends BaseController 
{
	public function login()
	{
		//$user = new User();
		return View::make('login');//,array('user'=>$user));
	}
	
	public function authenticate()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		
		if (empty($email) || empty($password)) {
			return Redirect::to('login');
		}
		else {
			$user = User::where('email','=',$email)->first();
			if (isset($user)) {
				if ($user->isAuthentic($password)){
					Session::put('user',$user->id);
					return Redirect::to('/');
				}
				else {
					return Redirect::to('login');
				}
			}
			else {
				$newUser = new User();
				$newUser->email = $email;
				$newUser->password = $password;
				$newUser->save();
				Session::put('user',$newUser->id);
				return Redirect::to('/');
			}
		}
	}
}