@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 mx-auto">
			<h1>Reports:</h1>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><a href="{{ route('report.calllog_responses') }}">All Calllog Responses</a></li>
			</ul>
		</div>
	</div>

@endsection