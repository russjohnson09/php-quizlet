@extends('layouts.main')

@section('content')
	{{Form::open(array('action'=>'MainController@authenticate'))}}
		{{Form::text('email')}}
		{{Form::password('password')}}
		{{Form::submit('Login')}}
	{{Form::close()}}
@stop
