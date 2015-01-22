<?php

use Carbon\Carbon;

class QuizletApiController extends \BaseController {

	private $data = array();
	
	private $quizlet_url = 'https://api.quizlet.com/2.0/';

	public function index()
	{
		$myClientId = $_ENV['quizlet_client_id'];
		$mySecret = $_ENV['quizlet_secret'];
		$myUrl = $_ENV['quizlet_redirect_url'];
		$authorizeUrl = $_ENV['quizlet_authorize_url'];
		$tokenUrl = $_ENV['quizlet_token_url'];
		$this->authorize();
	}
	
	public function showProfile()
	{
		$qu = QuizletUser::find(Session::get('quizletUserId'));
		
		$curl = curl_init("{$this->quizlet_url}users/".$qu->username);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$qu->access_token));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		return curl_exec($curl);
		//return curl_exec($curl);
		//$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		//curl_close($curl);
		
		//print_r($data);
		//return;
		
		// Display the user's sets
		echo "<p>Found ".count($data)." sets</p>";
		echo "<ol>";
		foreach ($data as $set) {
			echo "<li>".htmlspecialchars($set->title)."</li>"; // Notice that we ensure HTML is displayed safely
		}
		echo "</ol>";
	}
	
	public function apiRequest()
	{
		$endpoint = substr(Request::path(),4);
		//return $endpoint;
		//return Request::path();
		$qu = QuizletUser::find(Session::get('quizletUserId'));
		$curl = curl_init("{$this->quizlet_url}{$endpoint}");
		
		switch(Request::method()) {
			case 'post':
				curl_setopt($curl, CURLOPT_POST, true);
				break;
			case 'delete':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			case 'put':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			default:
				break;
		}
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$qu->access_token));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		return curl_exec($curl);
	}
}