<?php
Route::model('card', 'Card');
Route::resource('card','CardController');

Route::model('show', 'Show');
Route::resource('show','ShowController');

Route::model('episode', 'Episode');
Route::resource('episode','EpisodeController');

Route::get('/',function()
{
	return View::make('info');
});