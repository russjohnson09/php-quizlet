@extends('layouts.main')

@section('content')
		{{link_to_action('PostController@create','Add')}}
		@if (count($posts) > 0)
			<div class="posts">
			@foreach ($posts as $post)
				<div class="post">
					{{link_to_action('PostController@edit','Edit',$parameters = array('post' => $post->id), $attributes = array())}}
					{{link_to_action('PostController@show', 'View', $parameters = array('post' => $post->id), $attributes = array())}}
					<h1>{{ $post->title }}</h1>
					<p>
					{{$post->body}}
					</p>
				</div>
			@endforeach
			</div>
		@endif
@stop