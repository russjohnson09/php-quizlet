@extends('layouts.master')

@section('content')
	@foreach ($shows as $show)
		<div class="Show">
			<h1>{{ $show->title }}</h1>
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