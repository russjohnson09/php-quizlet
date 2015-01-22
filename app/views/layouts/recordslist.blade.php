@foreach ($records as $record)
	<?php $key = $record->getKeyName();?>
	<?php $record = $record->toArray(); ?>
	<div class="Record">
		<p>This is record {{ $record[$key] }}</p>
		<table>
			@foreach ($record as $key => $val)
				<tr>
				<td>{{$key}}</td><td>{{$val}}</td>
				</tr>
			@endforeach
		</table>
	</div>
@endforeach