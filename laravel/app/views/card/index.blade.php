<!-- Stored in app/views/layouts/master.blade.php -->
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
		@if (count($cards) > 0)
		<div class="cards">
		@foreach ($cards as $card)
			<div class="card">
				{{link_to_action('CardController@show', 'View', $parameters = array('card' => $card->id), $attributes = array())}}
				<p>This is card {{ $card->id }}</p>
				<ul>
				<li>{{$card->front}}</li>
				</ul>
			</div>
		@endforeach
		</div>
		@endif
    </body>
</html>