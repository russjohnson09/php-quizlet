<?php

use Carbon\Carbon;

class CardController extends \BaseController {

	private $data = array();

	public function index()
	{
		$myClientId = $_ENV['quizlet_client_id'];
		$mySecret = $_ENV['quizlet_secret'];
		$myUrl = $_ENV['quizlet_redirect_url'];
		$authorizeUrl = $_ENV['quizlet_authorize_url'];
		$tokenUrl = $_ENV['quizlet_token_url'];
		$this->authorize();
	}
}