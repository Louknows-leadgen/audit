@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">

			<div class="mb-3 d-flex justify-content-between">
				<span class="back" onclick="window.history.back();">Back</span>
				@if(!$is_audited)
					<a href="{{ route('ops.recording',['ops_user'=>$ops_id, 'ctr'=>$calllog->ctr]) }}" class="btn btn-secondary">Audit</a>
				@endif
			</div>

			<div class="box-bg p-3">
				<div class="d-flex flex-wrap justify-content-around">
					<div><label class="font-weight-bolder">User ID:</label> {{ isset($user_id) ? $user_id : '' }} </div>
					<div>
						<label class="font-weight-bolder">Name:</label> 
						{{ 
							isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' 
						}} 
					</div>
					<div>
						<label class="font-weight-bolder">Team Lead:</label> 
						{{ isset($emp->team_lead->full_name) ? $emp->team_lead->full_name : '(No record)' }} 
					</div>
					<div>
						<label class="font-weight-bolder">Audit Type:</label>
						{{ ucwords($audit_type) }}
					</div>
					<div>
						<label class="font-weight-bolder">Dispo:</label>
						{{ ucwords($calllog->dispo) }}
					</div>
				</div>
				<div class="mt-3 text-center">
					<audio class="w-75" id="audio" style="outline: none;" controls>
						<source src="{{ $recording_file['url'] }}" type="audio/{{ $recording_file['type'] }}">
					</audio>
				</div>
			</div>

			<div class="box-bg p-3">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="thead-light">
							<tr>
								<th>Script #</th>
								<th>Customer Statement</th>
								<th>Auditor's Comment</th>
								<th>Incorrect Tagging</th>
								<th>Inappropriate Response</th>
								<th>Incorrect Details</th>
								<th>Agent Corrections</th>
								<th>External Factors</th>
							</tr>
						</thead>
						<tbody>
						@if(count($calllog->script_responses))
							@foreach($calllog->script_responses as $sr)
								<tr>
									<td>{{ $sr->script->name }}</td>
									<td>{{ $sr->cust_statement }}</td>
									<td>{{ $sr->aud_comment }}</td>
									<td>{{ $sr->inc_tagging }}</td>
									<td>{{ $sr->inapp_resp }}</td>
									<td>{{ $sr->inc_detail }}</td>
									<td>
										@foreach($sr->agent_script_responses as $call_asr)
											<div>- {{ $call_asr->agent_correction->name }}</div>
										@endforeach
									</td>
									<td>
										@foreach($sr->external_script_response as $call_esr)
											<div>- {{ $call_esr->external_factor->name }}</div>
										@endforeach
									</td>
								</tr>
							@endforeach
						@else
							<tr class="text-center">
								<td colspan="8">No findings found</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
@endsection