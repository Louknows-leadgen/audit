<div class="row">
	<div class="col-md-12">

		<div class="alert cl-alert" style="display: none;">
			<strong>Success!</strong><span></span>
		</div>

		<div class="box">
			<form class="calllog-form" action="{{ route('supervisor.assign_calls') }}" method="post">
				<div class="row mb-3">
					<div class="col-md-7 mb-2">
						<div class="d-flex align-items-start">
							<div class="input-group mr-2">
								<input type="number" class="form-control input-select-custom">
								<div class="input-group-append">
									<span class="btn btn-secondary select-custom">Select</span>
								</div>
							</div>
							<div class="btn btn-secondary w-75 mr-2 select-all">Select All</div>
							<div class="btn btn-secondary w-75 mr-2 deselect-all">Deselect All</div>
						</div>
					</div>
					<div class="col-md-3">
							<select class="custom-select" name="assigned_team">
								<optgroup label="Teams/Group">
									@foreach($teams as $team)
										<option value="{{ $team->code }}">
											{{ $team->name }}
										</option>
									@endforeach
								</optgroup>
							</select>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary">Assign</button>
					</div>
				</div>

				<div class="calllogs-list">
					<table class="table table-bordered table-responsive w-100 d-block d-md-table">
						<thead class="thead-dark">
							<tr>
								<th></th>
								<th>User Id</th>
								<th>Recording Id</th>
								<th>Server Id</th>
								<th>Campaign</th>
								<th>Dispo</th>
								<th>Talk Time</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@if(count($calllogs))
								@foreach($calllogs as $calllog)
									<tr>
										<td class="text-center">
											<div class="app-checkbox d-inline-block">
												<input type="checkbox" 
													   name="calllogs[]"
													   id="cl-{{ $calllog->ctr }}"
													   value="{{ $calllog->ctr }}">
												<label class="checkmark" 
													   for="cl-{{ $calllog->ctr }}">   	
												</label>
											</div>
										</td>
										<td>{{ $calllog->user }}</td>
										<td>{{ $calllog->recording_id }}</td>
										<td>{{ $calllog->server_ip }}</td>
										<td>{{ $calllog->campaign }}</td>
										<td>{{ $calllog->dispo }}</td>
										<td>{{ $calllog->talk_time }}</td>
										<td>{{ date_format(date_create($calllog->timestamp),'m/d/Y H:i A') }}</td>
									</tr>
								@endforeach
							@else
								<tr class="text-center">
									<td colspan="7">Empty results</td>
								</tr>
							@endif
						</tbody>
					</table>
					@if (empty($from))
						{{ $calllogs->links() }}
					@else
						{{ $calllogs->appends(['from'=>$from,'to'=>$to,'sid'=>$sid,'campaign'=>$campaign,'dispo'=>$dispo,'user'=>$user]) }}
					@endif
				</div>
			</form>
		</div>
	</div>
</div>