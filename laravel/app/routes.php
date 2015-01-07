<?php
Route::model('card', 'Card');
Route::resource('card','CardController');

Route::get('/',function()
{
	return View::make('info');
});