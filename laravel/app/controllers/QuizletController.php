<?php

class QuizletController extends \BaseController 
{

	public function index()
	{
		if (Session::has('quizletUserId')) {
			return Redirect::action('CardController@index');
		}
		elseif($this->quizletLogin()) {
			return Redirect::action('CardController@index');
		}
		
	}
	
	private function quizletLogin()
	{
		$myClientId = $_ENV['quizlet_client_id'];
		$mySecret = $_ENV['quizlet_secret'];
		$myUrl = $_ENV['quizlet_redirect_url'];
		$authorizeUrl = $_ENV['quizlet_authorize_url'];
		$tokenUrl = $_ENV['quizlet_token_url'];
		if (!Input::has('code')) {
			Session::set('state', md5(mt_rand().microtime(true))); // CSRF protection
			echo '<a href="'.$authorizeUrl.'&state='.Session::get('state').'&redirect_uri='.$myUrl.'">Step 1: Start Authorization</a>';
			return;
		}
		// Check for issues from step 1:
		if (Input::has('error')) { // An error occurred authorizing
			displayError(Input::all());
			return;
		}
		if (Input::get('state') != Session::get('state')) {
			echo 'CSRF';
			return;
		}

		if (!Session::has('access_token')) {
			echo "<p>Step 1 completed - the user authorized our application.</p>";
			$payload = array(
				'code' => Request::get('code'),
				'redirect_uri' => $myUrl,
				'grant_type' => 'authorization_code'
			);
			$curl = curl_init($tokenUrl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //todo
			curl_setopt($curl, CURLOPT_USERPWD, "{$myClientId}:{$mySecret}");
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
			$token = json_decode(curl_exec($curl), true);
			$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
		 
			$accessToken = $token['access_token'];
			$username = $token['user_id']; // the API sends back the username of the user in the access token
		 
			$qu = QuizletUser::where('username',$username)->first();
			if (empty($qu)) {
				$qu = new QuizletUser();
				$qu->username = $username;
			}
			$qu->access_token = $accessToken;
			$qu->save();
			
			Session::set('quizletUserId',$qu->id);
		}
		
		return true;
	}
	
}