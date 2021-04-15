@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">

			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> {{ session('success') }}
				</div>
			@elseif(session('failed'))
				<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Failed!</strong> {{ session('failed') }}
				</div>
			@endif

			<div class="box">
				<h5>My Call Logs:</h5>

				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active">Current</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('auditor.my_call_logs_completed') }}">Completed</a>
					</li>
				</ul>

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
						@if(count($calllogs))
							@foreach($calllogs as $calllog)
								<tr>
									<td>{{ $calllog->recording_id }}</td>
									<td>{{ $calllog->user }}</td>
									<td>{{ $calllog->phone_number }}</td>
									<td><a class="btn btn-primary start-audit" href="{{ route('auditor.recording',['recording' => $calllog->recording_id]) }}">Start Audit</a></td>
								</tr>
							@endforeach
						@else
							<tr class="text-center"><td colspan="4">Empty results</td></tr>
						@endif
					</tbody>
				</table>
				{{ $calllogs->links() }}
			</div>
		</div>
	</div>
@endsection