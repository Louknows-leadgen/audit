@extends('layouts.app')

@section('content')

	<div class="gray-bg">
		<div class="d-flex flex-column align-items-center justify-content-center h-100">
			<div class="text-light">Please wait</div>
			<div>
				<div class="spinner-grow text-info"></div>
				<div class="spinner-grow text-info"></div>
				<div class="spinner-grow text-info"></div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="box">
					<h5>Search Options:</h5>
					<hr>
					<form action="{{ route('auditor.search_preference') }}" method="get">
						<div class="form-group">
							<label>Call From:</label>
							<input type="date" class="form-control" name="from" value="{{ isset($from) ? $from : '' }}">
						</div>
						<div class="form-group">
							<label>Call To:</label>
							<input type="date" class="form-control" name="to" value="{{ isset($to) ? $to : '' }}">
						</div>
						<div class="form-group">
							<label>Dispo:</label>
							<select class="form-control" name="dispo[]" multiple>
								@foreach($dispositions as $d)
									<option value="{{ $d->dispo }}" {{ isset($dispo) && in_array($d->dispo,$dispo) ? 'selected' : '' }}>{{ $d->dispo }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>User:</label>
							<select class="form-control" name="user">
								<option value="">All</option>
								@foreach($users as $u)
									<option value="{{ $u->user_id }}" {{ isset($user) && $user == $u->user_id ? 'selected' : '' }}>{{ $u->user_id }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-sm btn-primary" name="submit" value="Search">
						</div>
					</form>	
				</div>
			</div>
			<div class="col-md-8">
				<div class="alert cl-alert" style="display: none;">
					<strong></strong><span></span>
				</div>
				<div class="box">
					<form action="{{ route('auditor.bulk_search_claim_call') }}" method="post" id="bulk-search-claim">
						@csrf
						<button class="btn btn-secondary mb-3">Bulk Claim</button>
						<table class="table table-bordered table-responsive w-100 d-block d-md-table">
							<thead class="thead-dark">
								<tr>
									<th></th>
									<th>User</th>
									<th>Recording</th>
									<th>Dispo</th>
									<th>Talk Time</th>
									<th>Call Date (EST)</th>
								</tr>
							</thead>
							<tbody>
								@if(!$is_submit)
									<tr class="text-center">
										<td colspan="6">Enter Search Options</td>
									</tr>
								@elseif(!$calls->count())
									<tr class="text-center">
										<td colspan="6">No results found</td>
									</tr>
								@else
									@foreach($calls as $call)
										<tr>
											<td class="text-center">
												<div class="app-checkbox d-inline-block">
													<input type="checkbox" 
														   name="calllogs[]"
														   id="cl-{{ $call->ctr }}"
														   value="{{ $call->ctr }}">
													<label class="checkmark" 
														   for="cl-{{ $call->ctr }}">   	
													</label>
												</div>
											</td>
											<td>{{ $call->user }}</td>
											<td>{{ $call->recording_id }}</td>
											<td>{{ $call->dispo }}</td>
											<td>{{ $call->talk_time }}</td>
											<td>{{ date('m/d/Y h:i A',strtotime($call->timestamp)) }}</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</form>	
					@if($is_submit)
						{{ $calls->appends(['from'=>$from,'to'=>$to,'dispo'=>$dispo,'user'=>$user,'submit'=>$is_submit]) }}
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection