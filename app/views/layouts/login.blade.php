{{Form::open(array('url' => 'admin/login'))}}
	{{Form::label('username', 'Username')}}
	{{Form::text('username')}}
	{{Form::label('password','Password')}}
	{{Form::password('password')}}
	{{Form::submit('Login')}}
{{Form::close()}}
<a href="/admin/signup">Sign-up</a>