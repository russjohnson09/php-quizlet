@extends('layouts.master')

@section('content')
		{{link_to_action('CardController@create','Add')}}
		@if (count($cards) > 0)
			<div class="cards">
			@foreach ($cards as $card)
				<div class="card">
					{{link_to_action('CardController@edit','Edit',$parameters = array('card' => $card->id), $attributes = array())}}
					{{link_to_action('CardController@show', 'View', $parameters = array('card' => $card->id), $attributes = array())}}
					<p>This is card {{ $card->id }} it is 
					@if ($card->due)
						due.
					@else
						not due.
					@endif
					</p>
					<ul>
					<li>{{$card->front}}</li>
					</ul>
				</div>
			@endforeach
			</div>
		@endif
@stop