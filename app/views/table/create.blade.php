@extends('layouts.main')

@section('content')

<div class="error">
{{$errorMsg}}
</div>

<div class="table">
{{$tableName}}
</div>

{{Form::open(array('action' => 'TableCreateController@create'))}}

			{{Form::label('tableName', 'Table Name')}}
			{{Form::text('tableName')}}
			{{Form::submit('Create', array('name' => 'Create'))}}
			{{Form::submit('Drop', array('name' => 'Drop'))}}
			{{''//Form::submit('Add Integer', array('name' => Add Integer'))}}
		{{Form::close()}}
		
		@foreach($errors->all() as $m)
			{{$m}}
		@endforeach
		
		<div>Table List</div>
		<ul>
		@foreach($tables as $t)
			<li>
			<a href="?editTable={{$t['name']}}">{{$t['name']}}</a>
			@if(isset($t['columns']))
				<div class="columns">
					<table>
					<tr>
						<td>Name</td>
						<td>Type</td>
						<td>Nullable</td>
						<td>Primary Key</td>
					</tr>
					{{''//print_r($t['columns'])}}
					@foreach($t['columns'] as $c)
					<tr>
					{{''//print_r($c)}};
						<td>{{$c['Field']}}</td>
						<td>{{$c['Type']}}</td>
						<td>{{ucwords(strtolower($c['Null']))}}</td>
						<td>{{($c['Key'] == 'PRI' ? 'Yes' : 'No')}}</td>
					</tr>
					@endforeach
					</table>
				</div>
			@endif
			</li>
		@endforeach
		</ul>
@stop