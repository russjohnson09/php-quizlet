<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
        @section('sidebar')
        @show
        <div class="container">
			@yield('content')
		</div>
    </body>
</html>