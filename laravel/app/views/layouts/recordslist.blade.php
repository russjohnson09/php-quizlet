@foreach ($records as $record)
	<div class="Record">
		{{link_to_action("$controller"."@edit",'Edit',$parameters = array($record->id), $attributes = array())}}
		{{link_to_action("$controller"."@show", 'View', $parameters = array($record->id), $attributes = array())}}
		<p>This is record {{ $record->id }}</p>
	</div>
@endforeach