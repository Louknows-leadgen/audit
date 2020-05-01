<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="row mb-3">
				<div class="col-md-4">
					<button class="btn btn-secondary select-all">Select All</button>
					<button class="btn btn-secondary deselect-all">Deselect All</button>
				</div>
				<div class="col-md-5 d-flex">
					<label class="mr-2 my-0 align-self-center">Assign to:</label>
					<div class="flex-grow-1">
						<select class="custom-select">
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
											   id="cl-{{ $calllog->ctr }}">
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
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5">Empty results</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>