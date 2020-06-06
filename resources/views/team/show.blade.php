@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">

			@if (session('success'))
			    <div class="alert alert-success alert-dismissible fade show">
			    	<button type="button" class="close" data-dismiss="alert">&times;</button>
			        <strong>Success! </strong>{{ session('success') }}
			    </div>
			@endif

			<div class="bg-notif rem-user-team-notif">
				<div class="card">
					<div class="card-header">
						Remove Member?
					</div>
					<div class="card-body">
						Are you sure you want to remove this member?
					</div>
					<div class="card-footer">
						<div class="d-flex justify-content-end">
							<button class="btn btn-primary rem-user-team px-4 mr-3">Yes</button>
							<button class="btn btn-secondary cancel">Cancel</button>
						</div>
					</div>
				</div>
			</div>

			<div class="box">
				<div class="right-back">
					<a href="{{ route('supervisor.manage_teams') }}">Back to Teams</a>
				</div>
				<h5>Team Information</h5>
				<form action="{{ route('teams.update',['team'=>$team->code]) }}" method="post">
					@csrf
					@method('put')
					<div class="row">
						<div class="col-md-3 mb-2">
							<div class="form-group my-0">
								<label>Team Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$team->name) }}">

								<span class="invalid-feedback feedback-inline" role="alert">
		                            @error('name') {{ $message }} @enderror
		                        </span>
							</div>
						</div>
						<div class="col-md-5 mb-2">
							<div class="form-group my-0">
								<label>Short Description</label>
								<input type="text" class="form-control" name="short_desc" value="{{ $team->short_desc }}">
							</div>
						</div>
						<div class="col-md-3 mb-2">
							<div class="d-flex h-100 align-items-end">
								<button class="btn btn-primary">Update</button>
							</div>
						</div>
					</div>
				</form>

				<div class="row">
					<div class="col-md-8">
						<div class="card mt-4">
							<div class="card-header">
								<h5 class="mr-auto">Members</h5>
							</div>
							<div class="card-body">
								<table class="table table-bordered table-responsive w-100 d-block d-md-table">
									@foreach($team->user_teams as $user)
									    <!-- 
									    	$user->id here is the id column in user_teams table 
									    -->
										<tr data-id="{{ $user->id }}">
											<td>{{ $user->user_name }}</td>
											<td><button class="btn btn-sm btn-danger rem-user-team-trg">Remove</button></td>
										</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
						<div class="card mt-4">
							<div class="card-header">
								<h5 class="mr-auto">Available Auditors</h5>
							</div>
							<div class="card-body">
								<table class="table table-bordered table-responsive w-100 d-block d-md-table">
									@if(count($avail_users))
										@foreach($avail_users as $avail_user)
											<tr data-id="{{ $avail_user->id }}" data-team="{{ $team->code }}">
												<td>{{ $avail_user->name }}</td>
												<td><button class="btn btn-sm btn-success px-3 add-user-team">Add</button></td>
											</tr>
										@endforeach
									@else
										<tr>
											<td class="text-center">No available auditors as of the moment</td>
										</tr>
									@endif
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection