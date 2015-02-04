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
	$email = 'russjohnson09@gmail.com';
	$name = 'Russ';
	$subject = 'welcome';
	Mail::send('emails.welcome',array('name' => $name),function($message)
	{
		$subject = 'welcome';
		$email = 'russjohnson09@gamil.com';
		$name = 'Russ';
		$message->from('noreply@localhost', 'Do Not Reply');
		$message->to($email,$name)->subject($subject);
	});
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
	Route::get('{path?}/{path1?}/{path2?}/{path3?}/{path4?}','QuizletApiController@apiRequest');
});

Route::get('quizlet/(.*)','QuizletApiController@apiRequest');


//Route::get('/quizlet',array('as' => 'quizlet.index','uses' => 'QuizletApiController@index'));

Route::get('/quizlet','QuizletController@index');
Route::get('/admin/login','AdminController@login');
Route::post('/admin/login','AdminController@login');

Route::group(array('prefix' => '/admin','before' => 'auth'), function(){
	//Route::get('news','NewsController@index');
	Route::get('','AdminController@index');
});

Route::group(array('before'=>'newsAuth'), function() {
	Route::model('post', 'Post');
	Route::resource('post','PostController');
});