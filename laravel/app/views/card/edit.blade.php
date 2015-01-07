<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
		{{Form::model($card, array('route' => array('card.update', $card->id),'method' => 'put'))}}
			{{Form::label('front', 'Front')}}
			{{Form::text('front')}}
			<input type="submit" value="Save">
			<input type="submit" value="Save and Return">
		{{Form::close()}}
		
		{{Form::model($card, array('route' => array('card.review', $card->id),'method' => 'post'))}}
			<button type="submit" name="correct" value="1">Correct</button>
			<button type="submit">Incorrect</button>
		{{Form::close()}}
		
		@foreach($card->reviews as $rev)
			{{$rev}}
		@endforeach
    </body>
</html>