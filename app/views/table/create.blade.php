@extends('layouts.main')

@section('content')

<div class="error">
{{$errorMsg}}
</div>

{{Form::open(array('action' => 'TableCreateController@create'))}}

			{{Form::label('tableName', 'Table Name')}}
			{{Form::text('tableName')}}
			{{Form::submit('Create', array('name' => 'Create'))}}
			{{Form::submit('Drop', array('name' => 'Drop'))}}
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