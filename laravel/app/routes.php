<?php

Route::model('card', 'Card');
Route::group(array('before' => 'quizletAuth'), function() {
	Route::resource('card','CardController');
	Route::post('card/{card}/review',array('as' => 'card.review',
	'uses' => 'CardController@review'));
	});

Route::model('show', 'Show');
Route::resource('show','ShowController');

Route::model('episode', 'Episode');
Route::resource('episode','EpisodeController');

Route::get('/',function()
{
	return View::make('info');
});

Route::get('/flush',function(){
	Session::flush();
});

Route::group(array('prefix' => 'quizlet','before' => 'quizletAuth'), function() {
	Route::get('user',array('as' => 'quizlet.user', 'uses' => 'QuizletApiController@showProfile'));
	//Route::match(array('GET'), '(:any)', 'QuizletApiController@quizletApi');
});

Route::group(array('prefix' => 'api','before' => 'quizletAuth'),function(){
	Route::get('{path?}',function() {
		return 1;
	});
});

Route::get('quizlet/(.*)','QuizletApiController@apiRequest');


//Route::get('/quizlet',array('as' => 'quizlet.index','uses' => 'QuizletApiController@index'));

Route::get('/quizlet',function(){
	if (Session::has('quizletUserId')) {
		return Redirect::action('CardController@index');
	}
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
	
	return Redirect::action('CardController@index');
	 
	// Step 3: Use the Quizlet API with the received token
	// ===================================================
	echo "<p>Step 3 completed - Authorized as ".Session::get('username').".</p>";
	$curl = curl_init("https://api.quizlet.com/2.0/users/".Session::get('username')."/sets");
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //todo
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.Session::get('access_token')));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$data = json_decode(curl_exec($curl));
	$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	
	// Display the user's sets
	echo "<p>Found ".count($data)." sets</p>";
	echo "<ol>";
	foreach ($data as $set) {
		echo "<li>".htmlspecialchars($set->title)."</li>"; // Notice that we ensure HTML is displayed safely
	}
	echo "</ol>";
	
});


function displayError($error, $step) {
    echo '<h2>An error occurred in step '.$step.'</h2><p>Error: '.$error['error'].
        '<br />Description: '.(isset($error['error_description']) ? $error['error_description'] : 'n/a').'</p>';
};