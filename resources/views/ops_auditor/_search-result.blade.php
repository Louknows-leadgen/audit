@if(isset($call))
<div class="card">
	<div class="card-header"><h5 class="text-primary mb-0">Call Info</h5></div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-sm">
				<tbody>
					<tr>
						<td class="border-top-0"><strong>Recording ID:</strong></td>
						<td class="border-top-0">{{ $call->recording_id }}</td>
					</tr>
					<tr>
						<td><strong>Phone Number:</strong></td>
						<td>{{ $call->phone_number }}</td>
					</tr>
					<tr>
						<td><strong>User Group:</strong></td>
						<td>{{ ucfirst(strtolower($call->user_group)) }}</td>
					</tr>
					<tr>
						<td><strong>User:</strong></td>
						<td>{{ $call->user() }}</td>
					</tr>
					<tr>
						<td><strong>Call Date:</strong></td>
						<td>{{ $call->dateformat_moddyyyy() }}</td>
					</tr>
					<tr>
						<td><strong>Dispo:</strong></td>
						<td>{{ $call->dispo }}</td>
					</tr>
					<tr>
						<td><strong>Talk Time:</strong></td>
						<td>{{ $call->talk_time }}</td>
					</tr>
					<tr>
						<td><strong>Action:</strong></td>
						<td>
							<a class="btn btn-sm btn-secondary" href="{{ route('ops.recording',['ctr'=>$call->ctr]) }}">Audit</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>	
	</div>
</div>
@else
<div class="text-center">
	<span>No calls found</span>
</div>
@endif