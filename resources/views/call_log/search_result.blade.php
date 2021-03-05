<table class="table table-bordered table-responsive w-100 d-block d-md-table">
	<thead class="thead-dark">
		<tr>
			<th></th>
			<th>Recording Id</th>
			<th>Server Id</th>
			<th>Campaign</th>
			<th>Dispo</th>
			<th>Talk Time</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		@if(count($calls))
			@foreach($calls as $call)
			<tr>
				<td class="text-center">
					<div class="app-checkbox d-inline-block">
						<input type="checkbox" 
							   name="calllogs[]"
							   id="cl-{{ $call->ctr }}"
							   value="{{ $call->ctr }}">
						<label class="checkmark" 
							   for="cl-{{ $call->ctr }}">   	
						</label>
					</div>
				</td>
				<td>{{ $call->recording_id }}</td>
				<td>{{ $call->server_ip }}</td>
				<td>{{ $call->campaign }}</td>
				<td>{{ $call->dispo }}</td>
				<td>{{ $call->talk_time }}</td>
				<td>{{ date_format(date_create($call->timestamp),'m/d/Y H:i A') }}</td>
			</tr>
			@endforeach
		@else
			<tr class="text-center">
				<td colspan="7">Empty results</td>
			</tr>
		@endif
	</tbody>
</table>
<!-- {{ $calls->links() }} -->
{{ $calls->appends(['from'=>$from,'to'=>$to,'sid'=>$sid,'campaign'=>$campaign,'dispo'=>$dispo]) }}