<div class="row">
	<div class="col-md-12">

		<div class="alert cl-alert" style="display: none;">
			<strong>Success!</strong><span></span>
		</div>

		<div class="box">
			<form class="calllog-form" action="{{ route('supervisor.assign_calls') }}" method="post">
				<div class="row mb-3">
					<div class="col-md-4">
						<span class="btn btn-secondary select-all">Select All</span>
						<span class="btn btn-secondary deselect-all">Deselect All</span>
					</div>
					<div class="col-md-5 d-flex">
						<label class="mr-2 my-0 align-self-center">Assign to:</label>
						<div class="flex-grow-1">
							<select class="custom-select" name="assigned_team">
								@foreach($teams as $team)
									<option value="{{ $team->code }}">
										{{ $team->name }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary">Assign</button>
					</div>
					<div class="col-md-3">
						<div class="input-group mt-2">
							<input type="number" class="form-control">
							<div class="input-group-append">
								<span class="btn btn-secondary" type="submit">Select</span>
							</div>
						</div>
					</div>
				</div>

				<table class="table table-bordered table-responsive w-100 d-block d-md-table">
					<thead>
						<tr>
							<th></th>
							<th>Recording Id</th>
							<th>Server Id</th>
							<th>Campaign</th>
							<th>Dispo</th>
							<th>Talk Time</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody class="calllogs-list">
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
			</form>
		</div>
	</div>
</div>