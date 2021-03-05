@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="mb-5">
				<a href="{{ route('report.index') }}">
					<span class="back-icon">Back</span>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-primary mb-5 text-center">All Calllog Responses</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 mx-auto">
			<form action="{{ route('dl.calllog_responses') }}" method="post">
				@csrf
				<h4>Filter options:</h4>
				<div class="form-group">
					<label>From</label>
					<input type="date" name="from" class="form-control" required>
				</div>
				<div class="form-group">
					<label>To</label>
					<input type="date" name="to" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Download">
				</div>
			</form>
		</div>
	</div>

@endsection