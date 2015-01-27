<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{isset($title) ? $title : 'Quizlet'}}</title>
</head>
    <body class="body">
        <div id="container" class="container">
			@yield('content')
		</div>
    </body>
</html>
