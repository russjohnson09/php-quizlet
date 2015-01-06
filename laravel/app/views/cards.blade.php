<!-- Stored in app/views/layouts/master.blade.php -->
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
        <div>
			{{$cards}}
		</div>
		@if (count($cards) > 0)
		<div class="cards">
		@foreach ($cards as $card)
			<div class="card">
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