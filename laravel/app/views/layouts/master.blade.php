<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
</head>
    <body>
        @section('sidebar')
		<div>
			<?php $quizletUser = QuizletUser::find(Session::get('quizletUserId')); ?>
			{{$quizletUser}}
			1
		</div>
        @show
        <div class="container">
			@yield('content')
		</div>
    </body>
</html>