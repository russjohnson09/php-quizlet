<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
		{{Form::open(array('action' => array('CardController@store')))}}
			{{Form::label('front', 'Front')}}
			{{Form::text('front')}}
			<input type="submit" value="Save">
		</form>
		{{Form::close()}}
    </body>
</html>