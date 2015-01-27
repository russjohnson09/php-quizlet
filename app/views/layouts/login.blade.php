{{Form::open(array('url' => 'admin/login'))}}
	{{Form::label('username', 'Username')}}
	{{Form::text('username')}}
	{{Form::label('password','Password')}}
	{{Form::password('password')}}
	<button type="submit" name="login" value="1">Login</button>
	<button type="submit" name="create" value="1">Create Account</button>
{{Form::close()}}