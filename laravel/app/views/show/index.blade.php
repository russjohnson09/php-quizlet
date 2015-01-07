@extends('layouts.master')

@section('content')
	@foreach ($shows as $show)
		<div class="Show">
			<h1>{{ $show->title }}</h1>
			<h2>Genres</h2> <?php $first = true;?>
			<p>
			@foreach ($show->genres as $genre)
				@if ($first)
					<?php $first=false;?>
					<span>{{$genre->description}}</span>
				@else
					<span>, {{$genre->description}}</span>
				@endif
			@endforeach
			</p>
			<div class="episodes">
			<ul>
				@foreach ($show->episodes as $episode)
				<li>
					{{$episode->title}}
				</li>
				@endforeach
			</ul>
			</div>
		</div>
	@endforeach
@stop