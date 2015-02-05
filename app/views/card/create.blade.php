<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
    {{Form::model($card,
    array('route' => array('card.update', $card->id)))}}
    
    {{Form::close()}}
    </body>
</html>