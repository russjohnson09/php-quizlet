<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Info</title>
</head>

<body>

<h1>Enviroment Settings for {{App::environment()}}</h1>
<table>
@foreach ($_ENV as $key => $val)
<tr>
<td>{{$key}}</td><td>{{$val}}</td>
</tr>
@endforeach
</table>

<h1>Server</h1>
<table>
@foreach ($_SERVER as $key => $val)
<tr>
<td>{{$key}}</td><td>{{$val}}</td>
</tr>
@endforeach
</table>

{{phpinfo()}}

</body>