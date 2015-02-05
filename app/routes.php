<?php

Route::model('user','User');

Route::get('/',array('before'=>'auth',function()
{
	$user = Session::get('user');
	return Redirect::to("user/{$user}");
	return View::make('main');
}));

Route::get('/user/{user}',function($user){
	return View::make('main',array('user'=>$user));
});

Route::post('/authenticate',
array('uses'=>'MainController@authenticate'));
Route::get('/login',array('uses'=>'MainController@login'));

Route::get('/flush',function(){
	Session::flush();
	return Redirect::to('/');
});

return;
Route::get('/{path}',function($path){
	return App::make('MainController')->$path();
	return View::make($path);
});

return;
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