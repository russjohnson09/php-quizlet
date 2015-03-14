@extends('layouts.main')

@section('content')

{{Form::open(array('action' => 'TableCreateController@create'))}}

			{{Form::label('tableName', 'Table Name')}}
			{{Form::text('tableName')}}
			{{Form::submit('Create')}}
		{{Form::close()}}
@stop