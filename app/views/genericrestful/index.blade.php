@extends('layouts.main')

@section('content')
		{{link_to_action("{$controller}@create",'Add')}}
		@if (count($records) > 0)
			<div class="posts">
			@foreach ($records as $record)
				<div class="post">
					{{link_to_action("{$controller}@edit",'Edit',$parameters = array('record' => $record->id), $attributes = array())}}
					{{link_to_action("{$controller}@show", 'View', $parameters = array('record' => $record->id), $attributes = array())}}
					<h1>{{ $record->title }}</h1>
					<p>
					{{$record->body}}
					</p>
				</div>
			@endforeach
			</div>
		@endif
@stop