<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
		{{Form::model($card, array('route' => array('card.update', $card->id)))}}
			<?php foreach($card as $key => $val):?>
				{{Form::label($key, $key)}}
				{{Form::text($key, $val)}}
			<?php endforeach;?>
		</form>
    </body>
</html>