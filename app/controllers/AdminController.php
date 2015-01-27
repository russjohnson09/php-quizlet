<?php

class AdminController extends BaseController {

	protected $data = array('title' => 'Admin','errors' => array());
	
	public function index() {
		return View::make('admin.index');
	}
	
	public function login() {
		if (Request::isMethod('post'))
		{
			$rules = array(
			    'username'    => 'required|alphaNum|min:3', // make sure the email is an actual email
			    'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
			);
			$validator = Validator::make(Input::all(), $rules);
			if (Input::get('create')) {
				$user =  User::where('username',Input::get('username'))->first();
				if (!empty($user)) {
					$this->data['errors'][] = 'User already exists';
				}
				else {
					$user = new User();
					$user->password = Input::get('password');
					$user->username = Input::get('username');
					$user->save();
					return View::make('processing');
				}
			}
			if (Input::get('login')) {
				$user = User::where('username',Input::get('username'))->first();
				if (empty($user)) {
					return View::make('admin.login');
				}
				else {
					if (password_verify(Input::get('password'),$user->password)) {
						return $user;
					}
					return View::make('admin.login');
				}
			}
		}
		return View::make('admin.login');
	}

}
