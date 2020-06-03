@extends('layouts.app')

@section('content')
	<div clas="row">
		<div class="col-md-10 mx-auto">
			<div class="box">
				<div class="d-flex">
					<h4 class="mr-auto">Teams</h4>
					<button class="btn btn-success">Add New Team</button>
				</div>
				<hr>
				<div>
					<table class="table table-bordered table-responsive w-100 d-block d-md-table">
						<thead>
							<tr class="thead-light">
								<th>Team Name</th>
								<th>Members (#)</th>
								<th>Description</th>
								<th>Created Date</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($teams as $team)
								<tr id="{{ $team->code }}">
									<td>{{ $team->name }}</td>
									<td>{{ $team->user_teams->count() }}</td>
									<td>{{ $team->short_desc }}</td>
									<td>{{ format_date($team->created_at) }}</td>
									<td><button class="btn btn-primary">Edit Name</button></td>
									<td><button class="btn btn-secondary">Delete</button></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection