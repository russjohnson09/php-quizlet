<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public function setPasswordAttribute($v)
	{
		$this->attributes['password'] = password_hash($v,PASSWORD_DEFAULT);
	}
	

	public function isAuthentic($password)
	{
		$password2 = $this->password;
		return password_verify($password,$password2);
	}

}
