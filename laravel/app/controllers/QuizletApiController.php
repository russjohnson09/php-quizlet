<?php

use Carbon\Carbon;

class CardController extends \BaseController {

	private $data = array();

	public function index()
	{
		$this->authorize();
	}
}