@extends('layouts.main')

@section('content')

{{Form::open(array('action' => 'TableCreateController@create'))}}

			{{Form::label('tableName', 'Table Name')}}
			{{Form::text('tableName')}}
			{{Form::submit('Create')}}
		{{Form::close()}}
		
		@foreach($errors->all() as $m)
			{{$m}}
		@endforeach
		
		<div>Table List</div>
		<ul>
		@foreach($tables as $t)
			<li>
			{{$t}}
			</li>
		@endforeach
		</ul>
@stop