@extends('layouts.app')

@section('content')
	<div clas="row">

		<div class="bg-notif del-team-notif">
			<div class="card">
				<div class="card-header">
					Remove Team?
				</div>
				<div class="card-body">
					Are you sure you want to remove this team?
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary del-team px-4 mr-3">Yes</button>
						<button class="btn btn-secondary cancel">Cancel</button>
					</div>
				</div>
			</div>
		</div>


		<div class="bg-notif add-team-notif">
			<div class="card form-width">
				<div class="card-header">Create New Team</div>
				<div class="card-body">
					<form action="{{ route('teams.store') }}" method="post">
						@csrf
						<div class="form-group">
							<label>Team Name</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label>Short Description</label>
							<input type="text" name="short_desc" class="form-control">
						</div>
						<div class="d-flex justify-content-end">
							<button class="btn btn-primary mr-3">Create</button>
							<span class="btn btn-secondary cancel">Cancel</span>
						</div>
					</form>
				</div>
			</div>
		</div>


		<div class="col-md-10 mx-auto">

			@if($errors->any())
				<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					The ff. error prevented the system from adding the team:
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
				</div>
			@endif

			@if (session('success'))
			    <div class="alert alert-success alert-dismissible fade show">
			    	<button type="button" class="close" data-dismiss="alert">&times;</button>
			        <strong>Success! </strong>{{ session('success') }}
			    </div>
			@endif

			<div class="box">
				<div class="d-flex">
					<h4 class="mr-auto">Teams</h4>
					<button class="btn btn-success add-team-trig">Add New Team</button>
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
								<tr data-id="{{ $team->code }}">
									<td>{{ $team->name }}</td>
									<td>{{ $team->user_teams->count() }}</td>
									<td>{{ $team->short_desc }}</td>
									<td>{{ format_date($team->created_at) }}</td>
									<td class="text-center"><button class="btn btn-primary edit-team-trig">Edit</button></td>
									<td class="text-center"><button class="btn btn-secondary del-team-trg">Delete</button></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection