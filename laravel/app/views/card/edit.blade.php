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
		</form>
		{{Form::close()}}
    </body>
</html>