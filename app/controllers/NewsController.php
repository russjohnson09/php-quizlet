<?php

class NewsController extends BaseController {

	protected $data = array('title' => 'Admin');
	
	public function index() {
		return View::make('news.index');
	}

}
