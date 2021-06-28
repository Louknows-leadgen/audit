@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div>{{ $from }}</div>
		<div>{{ $to }}</div>
		<div>{{ print_r($dispo) }}</div>
		<div>{{ $user }}</div>
		<div class="row">
			<div class="col-md-3">
				<div class="box">
					<h5>Search Options:</h5>
					<hr>
					<form action="{{ route('ops.search_preference') }}" method="get">
						<div class="form-group">
							<label>Call From:</label>
							<input type="date" class="form-control" name="from">
						</div>
						<div class="form-group">
							<label>Call To:</label>
							<input type="date" class="form-control" name="to">
						</div>
						<div class="form-group">
							<label>Dispo:</label>
							<select class="form-control" name="dispo[]" multiple>
								@foreach($dispositions as $dispo)
									<option value="{{ $dispo->dispo }}">{{ $dispo->dispo }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>User:</label>
							<select class="form-control" name="user">
								<option value="-1">All</option>
								@foreach($users as $user)
									<option value="{{ $user->user_id }}">{{ $user->user_id }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-sm btn-primary" value="Search">
						</div>
					</form>	
				</div>
			</div>
			<div class="col-md-8">
				<div class="box">
					<div class="d-flex justify-content-end">
						<button class="btn btn-secondary mb-3">Bulk Select</button>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th></th>
									<th>User</th>
									<th>Recording</th>
									<th>Dispo</th>
									<th>Talk Time</th>
									<th>Call Date (EST)</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection