@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form class="audit_form" action="{{ route('auditor.submit_audit') }}" method="post">
				@csrf
				<div class="table-responsive">
					<table class="table table-bordered table-sm" style="min-width: 1466px;">
						<thead class="thead-dark">
							<tr>
								<th class="text-center align-middle">
									Recording ID: {{ $recording_id }}
									<input type="hidden" name="recording_id" value="{{ $recording_id }}">
								</th>
								<th colspan="4">
									<audio class="w-100" style="outline: none;" controls>
										<source src="{{ get_recording_location($recording_id) }}" type="audio/wav">
									</audio>
								</th>
							</tr>
							<tr>
								<th rowspan="3" class="text-center"></th>
								<th class="text-center">Customer</th>
								<th colspan="4" class="text-center">Agent</th>
								<th rowspan="2" colspan="3" class="text-center">Information</th>
								<th rowspan="3" class="text-center">Comment</th>
							</tr>
							<tr>
								<th rowspan="2" class="text-center">Statement (question/objection)</th>
								<th rowspan="2" class="text-center">Acknowledgement</th>
								<th colspan="3" class="text-center">Accuracy</th>
							</tr>
							<tr>
								<th>Agent response</th>
								<th>Speed</th>
								<th>Correct response</th>
								<th>Customer Details</th>
								<th>Agent Input</th>
								<th>Call Ends</th>
							</tr>
						</thead>
						<tbody class="audit-form">
							<tr class="text-center">
								<td>
									z01
									<input type="hidden" name="z01[script_code]" value="1">
									@php
										$z1 = get_recording_script(1,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z01[cust_statement]" class="w-100" value="{{ return_col_val($z1->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z01[acknowledge]" value="1" id="ack1-yes"
											       {{ isset($z1->acknowledgement) && $z1->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack1-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z01[acknowledge]" value="0" id="ack1-no"
											       {{ isset($z1->acknowledgement) && $z1->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack1-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z01[agent_response]" class="w-100" value="{{ return_col_val($z1->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z01[agent_response_speed]" class="w-100" value="{{ return_col_val($z1->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z01[correct_response]" class="w-100" value="{{ return_col_val($z1->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z01[customer_details]" class="w-100" value="{{ return_col_val($z1->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z01[agent_input]" class="w-100" value="{{ return_col_val($z1->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z01[comment]" class="w-100" value="{{ return_col_val($z1->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z02
									<input type="hidden" name="z02[script_code]" value="2">
									@php
										$z2 = get_recording_script(2,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z02[cust_statement]" class="w-100" value="{{ return_col_val($z2->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z02[acknowledge]" value="1" id="ack2-yes"
											       {{ isset($z2->acknowledgement) && $z2->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack2-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z02[acknowledge]" value="0" id="ack2-no"
											       {{ isset($z2->acknowledgement) && $z2->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack2-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z02[agent_response]" class="w-100" value="{{ return_col_val($z2->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z02[agent_response_speed]" class="w-100" value="{{ return_col_val($z2->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z02[correct_response]" class="w-100" value="{{ return_col_val($z2->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z02[customer_details]" class="w-100" value="{{ return_col_val($z2->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z02[agent_input]" class="w-100" value="{{ return_col_val($z2->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z02[comment]" class="w-100" value="{{ return_col_val($z2->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z03
									<input type="hidden" name="z03[script_code]" value="3">
									@php
										$z3 = get_recording_script(3,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z03[cust_statement]" class="w-100" value="{{ return_col_val($z3->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z03[acknowledge]" value="1" id="ack3-yes"
											       {{ isset($z3->acknowledgement) && $z3->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack3-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z03[acknowledge]" value="0" id="ack3-no"
											       {{ isset($z3->acknowledgement) && $z3->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack3-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z03[agent_response]" class="w-100" value="{{ return_col_val($z3->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z03[agent_response_speed]" class="w-100" value="{{ return_col_val($z3->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z03[correct_response]" class="w-100" value="{{ return_col_val($z3->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z03[customer_details]" class="w-100" value="{{ return_col_val($z3->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z03[agent_input]" class="w-100" value="{{ return_col_val($z3->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z03[comment]" class="w-100" value="{{ return_col_val($z3->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z04
									<input type="hidden" name="z04[script_code]" value="4">
									@php
										$z4 = get_recording_script(4,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z04[cust_statement]" class="w-100" value="{{ return_col_val($z4->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z04[acknowledge]" value="1" id="ack4-yes"
											       {{ isset($z4->acknowledgement) && $z4->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack4-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z04[acknowledge]" value="0" id="ack4-no"
											       {{ isset($z4->acknowledgement) && $z4->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack4-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z04[agent_response]" class="w-100" value="{{ return_col_val($z4->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z04[agent_response_speed]" class="w-100" value="{{ return_col_val($z4->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z04[correct_response]" class="w-100" value="{{ return_col_val($z4->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z04[customer_details]" class="w-100" value="{{ return_col_val($z4->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z04[agent_input]" class="w-100" value="{{ return_col_val($z4->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z04[comment]" class="w-100" value="{{ return_col_val($z4->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z16
									<input type="hidden" name="z16[script_code]" value="16">
									@php
										$z16 = get_recording_script(16,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z16[cust_statement]" class="w-100" value="{{ return_col_val($z16->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z16[acknowledge]" value="1" id="ack16-yes"
											       {{ isset($z16->acknowledgement) && $z16->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack16-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z16[acknowledge]" value="0" id="ack16-no"
											       {{ isset($z16->acknowledgement) && $z16->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack16-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z16[agent_response]" class="w-100" value="{{ return_col_val($z16->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z16[agent_response_speed]" class="w-100" value="{{ return_col_val($z16->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z16[correct_response]" class="w-100" value="{{ return_col_val($z16->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z16[customer_details]" class="w-100" value="{{ return_col_val($z16->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z16[agent_input]" class="w-100" value="{{ return_col_val($z16->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z16[comment]" class="w-100" value="{{ return_col_val($z16->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z05
									<input type="hidden" name="z05[script_code]" value="5">
									@php
										$z5 = get_recording_script(5,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z05[cust_statement]" class="w-100" value="{{ return_col_val($z5->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z05[acknowledge]" value="1" id="ack5-yes"
											       {{ isset($z5->acknowledgement) && $z5->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack5-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z05[acknowledge]" value="0" id="ack5-no"
											       {{ isset($z5->acknowledgement) && $z5->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack5-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z05[agent_response]" class="w-100" value="{{ return_col_val($z5->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z05[agent_response_speed]" class="w-100" value="{{ return_col_val($z5->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z05[correct_response]" class="w-100" value="{{ return_col_val($z5->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z05[customer_details]" class="w-100" value="{{ return_col_val($z5->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z05[agent_input]" class="w-100" value="{{ return_col_val($z5->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z05[comment]" class="w-100" value="{{ return_col_val($z5->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z06
									<input type="hidden" name="z06[script_code]" value="6">
									@php
										$z6 = get_recording_script(6,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z06[cust_statement]" class="w-100" value="{{ return_col_val($z6->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z06[acknowledge]" value="1" id="ack6-yes"
											       {{ isset($z6->acknowledgement) && $z6->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack6-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z06[acknowledge]" value="0" id="ack6-no"
											       {{ isset($z6->acknowledgement) && $z6->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack6-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z06[agent_response]" class="w-100" value="{{ return_col_val($z6->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z06[agent_response_speed]" class="w-100" value="{{ return_col_val($z6->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z06[correct_response]" class="w-100" value="{{ return_col_val($z6->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z06[customer_details]" class="w-100" value="{{ return_col_val($z6->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z06[agent_input]" class="w-100" value="{{ return_col_val($z6->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z06[comment]" class="w-100" value="{{ return_col_val($z6->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z07
									<input type="hidden" name="z07[script_code]" value="7">
									@php
										$z7 = get_recording_script(7,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z07[cust_statement]" class="w-100" value="{{ return_col_val($z7->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z07[acknowledge]" value="1" id="ack7-yes"
											       {{ isset($z7->acknowledgement) && $z7->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack7-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z07[acknowledge]" value="0" id="ack7-no"
											       {{ isset($z7->acknowledgement) && $z7->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack7-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z07[agent_response]" class="w-100" value="{{ return_col_val($z7->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z07[agent_response_speed]" class="w-100" value="{{ return_col_val($z7->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z07[correct_response]" class="w-100" value="{{ return_col_val($z7->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z07[customer_details]" class="w-100" value="{{ return_col_val($z7->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z07[agent_input]" class="w-100" value="{{ return_col_val($z7->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z07[comment]" class="w-100" value="{{ return_col_val($z7->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z15
									<input type="hidden" name="z15[script_code]" value="15">
									@php
										$z15 = get_recording_script(15,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z15[cust_statement]" class="w-100" value="{{ return_col_val($z15->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z15[acknowledge]" value="1" id="ack15-yes"
											       {{ isset($z15->acknowledgement) && $z15->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack15-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z15[acknowledge]" value="0" id="ack15-no"
											       {{ isset($z15->acknowledgement) && $z15->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack15-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z15[agent_response]" class="w-100" value="{{ return_col_val($z15->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z15[agent_response_speed]" class="w-100" value="{{ return_col_val($z15->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z15[correct_response]" class="w-100" value="{{ return_col_val($z15->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z15[customer_details]" class="w-100" value="{{ return_col_val($z15->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z15[agent_input]" class="w-100" value="{{ return_col_val($z15->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z15[comment]" class="w-100" value="{{ return_col_val($z15->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z08
									<input type="hidden" name="z08[script_code]" value="8">
									@php
										$z8 = get_recording_script(8,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z08[cust_statement]" class="w-100" value="{{ return_col_val($z8->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z08[acknowledge]" value="1" id="ack8-yes"
											       {{ isset($z8->acknowledgement) && $z8->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack8-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z08[acknowledge]" value="0" id="ack8-no"
											       {{ isset($z8->acknowledgement) && $z8->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack8-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z08[agent_response]" class="w-100" value="{{ return_col_val($z8->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z08[agent_response_speed]" class="w-100" value="{{ return_col_val($z8->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z08[correct_response]" class="w-100" value="{{ return_col_val($z8->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z08[customer_details]" class="w-100" value="{{ return_col_val($z8->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z08[agent_input]" class="w-100" value="{{ return_col_val($z8->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z08[comment]" class="w-100" value="{{ return_col_val($z8->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z09
									<input type="hidden" name="z09[script_code]" value="9">
									@php
										$z9 = get_recording_script(9,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z09[cust_statement]" class="w-100" value="{{ return_col_val($z9->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z09[acknowledge]" value="1" id="ack9-yes"
											       {{ isset($z9->acknowledgement) && $z9->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack9-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z09[acknowledge]" value="0" id="ack9-no"
											       {{ isset($z9->acknowledgement) && $z9->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack9-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z09[agent_response]" class="w-100" value="{{ return_col_val($z9->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z09[agent_response_speed]" class="w-100" value="{{ return_col_val($z9->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z09[correct_response]" class="w-100" value="{{ return_col_val($z9->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z09[customer_details]" class="w-100" value="{{ return_col_val($z9->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z09[agent_input]" class="w-100" value="{{ return_col_val($z9->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z09[comment]" class="w-100" value="{{ return_col_val($z9->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z10
									<input type="hidden" name="z10[script_code]" value="10">
									@php
										$z10 = get_recording_script(10,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z10[cust_statement]" class="w-100" value="{{ return_col_val($z10->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z10[acknowledge]" value="1" id="ack10-yes"
											       {{ isset($z10->acknowledgement) && $z10->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack10-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z10[acknowledge]" value="0" id="ack10-no"
											       {{ isset($z10->acknowledgement) && $z10->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack10-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z10[agent_response]" class="w-100" value="{{ return_col_val($z10->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z10[agent_response_speed]" class="w-100" value="{{ return_col_val($z10->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z10[correct_response]" class="w-100" value="{{ return_col_val($z10->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z10[customer_details]" class="w-100" value="{{ return_col_val($z10->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z10[agent_input]" class="w-100" value="{{ return_col_val($z10->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z10[comment]" class="w-100" value="{{ return_col_val($z10->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z11
									<input type="hidden" name="z11[script_code]" value="11">
									@php
										$z11 = get_recording_script(11,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z11[cust_statement]" class="w-100" value="{{ return_col_val($z11->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z11[acknowledge]" value="1" id="ack11-yes"
											       {{ isset($z11->acknowledgement) && $z11->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack11-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z11[acknowledge]" value="0" id="ack11-no"
											       {{ isset($z11->acknowledgement) && $z11->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack11-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z11[agent_response]" class="w-100" value="{{ return_col_val($z11->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z11[agent_response_speed]" class="w-100" value="{{ return_col_val($z11->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z11[correct_response]" class="w-100" value="{{ return_col_val($z11->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z11[customer_details]" class="w-100" value="{{ return_col_val($z11->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z11[agent_input]" class="w-100" value="{{ return_col_val($z11->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z11[comment]" class="w-100" value="{{ return_col_val($z11->comment) }}">
								</td>
							</tr>
							<tr class="text-center">
								<td>
									z12
									<input type="hidden" name="z12[script_code]" value="12">
									@php
										$z12 = get_recording_script(12,$recording_id);
									@endphp
								</td>
								<td>
									<input type="text" name="z12[cust_statement]" class="w-100" value="{{ return_col_val($z12->cust_statement) }}">
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<div>
											<input type="radio" name="z12[acknowledge]" value="1" id="ack12-yes"
											       {{ isset($z12->acknowledgement) && $z12->acknowledgement == 1 ? 'checked' : '' }}>
											<label for="ack12-yes">Yes</label>
										</div>
										<div>
											<input type="radio" name="z12[acknowledge]" value="0" id="ack12-no"
											       {{ isset($z12->acknowledgement) && $z12->acknowledgement == 0 ? 'checked' : '' }}>
											<label for="ack12-no">No</label>
										</div>
									</div>
								</td>
								<td>
									<input type="text" name="z12[agent_response]" class="w-100" value="{{ return_col_val($z12->agent_resp) }}">
								</td>
								<td>
									<input type="number" name="z12[agent_response_speed]" class="w-100" value="{{ return_col_val($z12->agent_resp_spd) }}">
								</td>
								<td>
									<input type="text" name="z12[correct_response]" class="w-100" value="{{ return_col_val($z12->correct_response) }}">
								</td>
								<td>
									<input type="text" name="z12[customer_details]" class="w-100" value="{{ return_col_val($z12->cust_dtl) }}">
								</td>
								<td>
									<input type="text" name="z12[agent_input]" class="w-100" value="{{ return_col_val($z12->agent_iput) }}">
								</td>
								<td>
									<input type="checkbox" id="end_call" class="w-100" onClick="this.form.submit()">
								</td>
								<td>
									<input type="text" name="z12[comment]" class="w-100" value="{{ return_col_val($z12->comment) }}">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>	
		</div>
	</div>
</div>

@endsection