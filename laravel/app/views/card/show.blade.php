<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
        <div>
			{{$card->id}}
			{{$card->front}}
		</div>
		{{link_to_action('CardController@destroy', 'Destroy', $parameters = array('card' => $card->id), $attributes = array())}}
    </body>
</html>