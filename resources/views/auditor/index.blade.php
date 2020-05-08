@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="alert cl-alert" style="display: none;">
				<strong></strong><span></span>
			</div>

			<div class="box">
				<h5>Available Call Logs:</h5>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="d-flex align-items-start">
							<div class="input-group mr-2">
								<input type="number" class="form-control input-select-custom">
								<div class="input-group-append">
									<span class="btn btn-secondary select-custom">Select</span>
								</div>
							</div>
							<button class="btn btn-primary w-50 mb-2">Bulk Claim</button>
						</div>
					</div>
				</div>
				
				<table class="table table-bordered table-sm table-responsive w-100 d-block d-md-table">
					<thead class="thead-dark">
						<tr>
							<th></th>
							<th>Record ID</th>
							<th>Agent ID</th>
							<th>Phone</th>
							<th>Talk Time</th>
							<th>Action</th>
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
								<td>{{ $calllog->user }}</td>
								<td>{{ $calllog->phone_number }}</td>
								<td>{{ $calllog->talk_time }}</td>
								<td class="text-center">
									<form action="{{ route('auditor.claim_call') }}" 
										  method="post"
										  class="claim-call">
										<input type="hidden" 
											   name="call_id" 
											   value="{{ $calllog->ctr }}">
										<button class="btn btn-primary"> Claim </button>
									</form>
								</td>
							</tr>
						@endforeach
						@else
							<tr class="text-center">
								<td colspan="6">Empty results</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection