@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="box">
				<h5>My Call Logs:</h5>
				<table class="table table-bordered table-sm table-responsive w-100 d-block d-md-table">
					<thead class="thead-dark">
						<tr>
							<th>Record ID</th>
							<th>Agent ID</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($calllogs as $calllog)
							<tr>
								<td>{{ $calllog->recording_id }}</td>
								<td>{{ $calllog->user }}</td>
								<td>{{ $calllog->phone_number }}</td>
								<td><button class="btn btn-primary start-audit" data-id="{{ $calllog->ctr }}">Start Audit</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@foreach($calllogs as $calllog)
		@include('auditor.script_forms.modal')
	@endforeach
@endsection