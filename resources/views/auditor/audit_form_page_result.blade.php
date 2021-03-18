<div class="table-responsive">
	<h4>Result:</h4>
	<table class="table table-bordered">
		<thead class="thead-light">
			<tr>
				<th>Dispo</th>
				<th>Count</th>
			</tr>
		</thead>
		<tbody>
			@if(count($calls))
				@foreach($calls as $call)
					<tr>
						<td>{{ $call->dispo }}</td>
						<td>{{ $call->total }}</td>
					</tr>
				@endforeach
			@else
					<tr>
						<td class="text-center" colspan="2">No results found</td>
					</tr>
			@endif
		</tbody>
	</table>
</div>