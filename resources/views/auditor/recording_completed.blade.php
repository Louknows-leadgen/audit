@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">

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
						{{ isset($emp->team_assignment->team_supervisor->TeamSupervisor) ? $emp->team_assignment->team_supervisor->TeamSupervisor : '(No record)' }} 
					</div>
					<div>
						<label class="font-weight-bolder">Audit Type:</label>
						{{ ucwords($audit_type) }}
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
					<table>
						<thead>
							<tr>
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
							<tr>
								<td>{{ $calllog->cust_statement }}</td>
								<td>{{ $calllog->aud_comment }}</td>
								<td>{{ $calllog->inc_tagging }}</td>
								<td>{{ $calllog->inapp_resp }}</td>
								<td>{{ $calllog->inc_detail }}</td>
								<td>
									@foreach($calllog->agent_script_responses as $call_asr)
										{{ nl2br('- ' . $call_asr->agent_correction->name . '\n') }}
									@endforeach
								</td>
								<td>
									@foreach($calllog->external_script_response as $call_esr)
										{{ nl2br('- ' . $call_esr->external_factor->name . '\n') }}
									@endforeach
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				{{ print_r($calllog) }}
			</div>

		</div>
	</div>
@endsection