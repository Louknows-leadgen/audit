@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="box">
				<h5>Claimed Call Logs:</h5>
				<table class="table table-bordered table-sm table-responsive w-100 d-block d-md-table">
					<thead class="thead-dark">
						<tr>
							<th>Record ID</th>
							<th>Recording Date</th>
							<th>Agent ID</th>
							<th>Phone</th>
							<th>Auditor</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@if(count($calllogs))
							@foreach($calllogs as $calllog)
								<tr>
									<td>{{ $calllog->recording_id }}</td>
									<td>{{ date('m/d/Y',strtotime($calllog->timestamp)) }}</td>
									<td>{{ $calllog->user }}</td>
									<td>{{ $calllog->phone_number }}</td>
									<td>{{ $calllog->auditor->name }}</td>
									<td>{{ $calllog->status_name }}</td>
								</tr>
							@endforeach
						@else
							<tr class="text-center"><td colspan="5">Empty results</td></tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection