<div class="row">
	<div class="col-md-12">
		<div class="box">
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