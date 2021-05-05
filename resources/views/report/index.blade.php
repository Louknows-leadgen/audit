@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 mx-auto">
			<h3>Reports:</h3>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><a href="{{ route('report.calllog_responses') }}">All Calllog Responses</a></li>
				@if($user_role == 4)
					<li class="list-group-item"><a href="{{ route('auditor.my-audits') }}">My Audits</a></li>
				@endif
				@if($user_role < 4)
					<li class="list-group-item"><a href="{{ route('report.auditors_hourly') }}">Auditors Hourly</a></li>
				@endif
			</ul>
		</div>
	</div>

@endsection