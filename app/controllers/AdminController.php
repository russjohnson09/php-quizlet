<?php

class AdminController extends BaseController {

	protected $data = array('title' => 'Admin');
	
	public function index() {
		return View::make('admin.index');
	}
	
	public function login() {
		return View::make('admin.login');
	}

}
