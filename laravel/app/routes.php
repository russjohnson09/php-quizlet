<?php
Route::model('card', 'Card');
Route::resource('card','CardController');

Route::post('card/{card}/review',array('as' => 'card.review','uses' => 'CardController@review'));

Route::model('show', 'Show');
Route::resource('show','ShowController');

Route::model('episode', 'Episode');
Route::resource('episode','EpisodeController');

Route::get('/',function()
{
	return View::make('info');
});


//Route::get('/quizlet',array('as' => 'quizlet.index','uses' => 'QuizletApiController@index'));

Route::get('/quizlet',function(){
	$myClientId = $_ENV['quizlet_client_id'];
	$mySecret = $_ENV['quizlet_secret'];
	$myUrl = $_ENV['quizlet_redirect_url'];
	$authorizeUrl = $_ENV['quizlet_authorize_url'];
	$tokenUrl = $_ENV['quizlet_token_url'];
	if (!Input::has('code') && !Input::has('error')) {
		Session::set('state', md5(mt_rand().microtime(true))); // CSRF protection
		echo Session::get('state');
		print_r($authorizeUrl);
		//echo $myUrl;
		return;
		echo '<a href="'.$authorizeUrl.'&state='.Session::get('state').'&redirect_uri='.$myUrl.'">Step 1: Start Authorization</a>';
		return;
	}
	 
	// Check for issues from step 1:
	if (empty(Input::has('error'))) { // An error occurred authorizing
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
		curl_setopt($curl, CURLOPT_USERPWD, "{$myClientId}:{$mySecret}");
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
		$token = json_decode(curl_exec($curl), true);
		$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
	 
		if ($responseCode != 200) { // An error occurred getting the token
			displayError($token, 2);
			exit();
		}
	 
		$accessToken = $token['access_token'];
		$username = $token['user_id']; // the API sends back the username of the user in the access token
	 
		// Store the token for later use (outside of this example, you might use a real database)
		// You must treat the "access token" like a password and store it securely
		Session::put('access_token',$accessToken);
		Session::put('username',$username);
	 
		echo "<p>Step 2 completed - access token was received.</p>";
	}
	 
	// Step 3: Use the Quizlet API with the received token
	// ===================================================
	echo "<p>Step 3 completed - Authorized as {$_SESSION['username']}.</p>";
	$curl = curl_init("https://api.quizlet.com/2.0/users/{$_SESSION['username']}/sets");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$_SESSION['access_token']));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$data = json_decode(curl_exec($curl));
	$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	 
	if (floor($responseCode / 100) != 2) { // A non 200-level code is an error (our API typically responds with 200 and 204 on success)
		displayError((array) $data, 3);
		exit();
	}
	 
	// Display the user's sets
	echo "<p>Found ".count($data)." sets</p>";
	echo "<ol>";
	foreach ($data as $set) {
		echo "<li>".htmlspecialchars($set->title)."</li>"; // Notice that we ensure HTML is displayed safely
	}
	echo "</ol>";
	
	//Session::put('key', 'value');
	
	//$value = Session::get('key');
	
});


function displayError($error, $step) {
    echo '<h2>An error occurred in step '.$step.'</h2><p>Error: '.$error['error'].
        '<br />Description: '.(isset($error['error_description']) ? $error['error_description'] : 'n/a').'</p>';
};