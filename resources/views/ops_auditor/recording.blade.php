@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-11 px-0 mb-3">

			<div class="mb-3">
				<span class="back" onclick="window.history.back();">Back</span>
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
		</div>
	</div>
</div>

<div class="container border">
	<div class="row">
		<div class="col-md-1 p-0">
			<div class="tab py-2 text-center btn-blue" data-content="Z01">Z01</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z02">Z02</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z03">Z03</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z04">Z04</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z05">Z05</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z06">Z06</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z07">Z07</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z08">Z08</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z16">Z16</div>			
			<div class="tab py-2 text-center btn-blue" data-content="Z09">Z09</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z10">Z10</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z11">Z11</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z12">Z12</div>
		</div>
		<div class="col-md-11 p-0">
			<div class="box-bg">
				<form action="{{ route('auditor.submit_audit') }}" method="post">
					@csrf
					<input type="hidden" name="ctr" value="{{ $calllog->ctr }}">
					<input type="hidden" name="audit_start" value="">
					<!-- Z01 -->
					<div class="tabcontent inactive p-3" id="Z01">
						<input type="hidden" name="responses[z1][id]" value="1">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z1][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z1][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z1-alist1">No intro</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z1-alist2">Delayed intro</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z1-alist3">Did not proceed to z02</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z1-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z1-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle in_response" id="z1-alist6" value="6">
												<label class="align-middle mb-0 ml-2" for="z1-alist6">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z1][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist7" value="7">
												<label class="align-middle mb-0 ml-2" for="z1-alist7">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle in_response" id="z1-alist8" value="8" value="1">
												<label class="align-middle mb-0 ml-2" for="z1-alist8">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z1][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist9" value="9">
												<label class="align-middle mb-0 ml-2" for="z1-alist9">Call avoidance</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][agent_correction][]" class="align-middle" id="z1-alist10" value="10">
												<label class="align-middle mb-0 ml-2" for="z1-alist10">Stayed on the line for too long</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][external_factor][]" class="align-middle" id="z1-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z1-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][external_factor][]" class="align-middle" id="z1-elist2" value="4">
												<label class="align-middle mb-0 ml-2" for="z1-elist2">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z1][external_factor][]" class="align-middle" id="z1-elist3" value="5">
												<label class="align-middle mb-0 ml-2" for="z1-elist3">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z02 -->
					<div class="tabcontent inactive p-3" id="Z02">
						<input type="hidden" name="responses[z2][id]" value="2">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z2][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z2][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle" id="z2-alist1" value="4">
												<label class="align-middle mb-0 ml-2" for="z2-alist1">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle" id="z2-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z2-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle in_response" id="z2-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z2-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z2][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle" id="z2-alist4" value="5">
												<label class="align-middle mb-0 ml-2" for="z2-alist4">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle in_response" id="z2-alist5" value="8">
												<label class="align-middle mb-0 ml-2" for="z2-alist5">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z2][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle" id="z2-alist6" value="7">
												<label class="align-middle mb-0 ml-2" for="z2-alist6">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle" id="z2-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z2-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][agent_correction][]" class="align-middle in_response" id="z2-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z2-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z2][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][external_factor][]" class="align-middle" id="z2-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z2-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][external_factor][]" class="align-middle" id="z2-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z2-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][external_factor][]" class="align-middle" id="z2-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z2-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][external_factor][]" class="align-middle" id="z2-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z2-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z2][external_factor][]" class="align-middle" id="z2-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z2-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z03 -->
					<div class="tabcontent inactive p-3" id="Z03">
						<input type="hidden" name="responses[z3][id]" value="3">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z3][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z3][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle" id="z3-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z3-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle" id="z3-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z3-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle in_response" id="z3-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z3-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z3][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle" id="z3-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z3-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle" id="z3-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z3-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle in_response" id="z3-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z3-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z3][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle" id="z3-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z3-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][agent_correction][]" class="align-middle in_response" id="z3-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z3-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z3][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][external_factor][]" class="align-middle" id="z3-elist1" value="2">
												<label class="align-middle mb-0 ml-2" for="z3-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][external_factor][]" class="align-middle" id="z3-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z3-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][external_factor][]" class="align-middle" id="z3-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z3-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][external_factor][]" class="align-middle" id="z3-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z3-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z3][external_factor][]" class="align-middle" id="z3-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z3-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z04 -->
					<div class="tabcontent inactive p-3" id="Z04">
						<input type="hidden" name="responses[z4][id]" value="4">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z4][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z4][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle" id="z4-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z4-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle" id="z4-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z4-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle in_response" id="z4-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z4-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z4][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle" id="z4-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z4-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle" id="z4-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z4-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle in_response" id="z4-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z4-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z4][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle" id="z4-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z4-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][agent_correction][]" class="align-middle in_response" id="z4-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z4-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z4][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][external_factor][]" class="align-middle" id="z4-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z4-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][external_factor][]" class="align-middle" id="z4-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z4-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][external_factor][]" class="align-middle" id="z4-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z4-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][external_factor][]" class="align-middle" id="z4-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z4-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z4][external_factor][]" class="align-middle" id="z4-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z4-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z05 -->
					<div class="tabcontent inactive p-3" id="Z05">
						<input type="hidden" name="responses[z5][id]" value="5">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z5][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z5][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle" id="z5-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z5-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle" id="z5-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z5-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle" id="z5-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z5-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle in_response" id="z5-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z5-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z5][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle" id="z5-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z5-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle in_response" id="z5-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z5-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z5][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle" id="z5-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z5-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][agent_correction][]" class="align-middle in_response" id="z5-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z5-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z5][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][external_factor][]" class="align-middle" id="z5-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z5-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][external_factor][]" class="align-middle" id="z5-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z5-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][external_factor][]" class="align-middle" id="z5-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z5-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][external_factor][]" class="align-middle" id="z5-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z5-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z5][external_factor][]" class="align-middle" id="z5-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z5-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z06 -->
					<div class="tabcontent inactive p-3" id="Z06">
						<input type="hidden" name="responses[z6][id]" value="6">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z6][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z6][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle" id="z6-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z6-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle" id="z6-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z6-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle" id="z6-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z6-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle in_response" id="z6-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z6-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z6][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle" id="z6-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z6-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle in_response" id="z6-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z6-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z6][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle" id="z6-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z6-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][agent_correction][]" class="align-middle in_response" id="z6-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z6-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z6][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][external_factor][]" class="align-middle" id="z6-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z6-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][external_factor][]" class="align-middle" id="z6-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z6-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][external_factor][]" class="align-middle" id="z6-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z6-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][external_factor][]" class="align-middle" id="z6-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z6-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z6][external_factor][]" class="align-middle" id="z6-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z6-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z07 -->
					<div class="tabcontent inactive p-3" id="Z07">
						<input type="hidden" name="responses[z7][id]" value="7">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z7][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z7][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle" id="z7-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z7-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle" id="z7-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z7-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle" id="z7-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z7-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle in_response" id="z7-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z7-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z7][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle" id="z7-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z7-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle in_response" id="z7-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z7-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z7][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle" id="z7-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z7-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][agent_correction][]" class="align-middle in_response" id="z7-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z7-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z7][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][external_factor][]" class="align-middle" id="z7-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z7-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][external_factor][]" class="align-middle" id="z7-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z7-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][external_factor][]" class="align-middle" id="z7-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z7-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][external_factor][]" class="align-middle" id="z7-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z7-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z7][external_factor][]" class="align-middle" id="z7-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z7-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z08 -->
					<div class="tabcontent inactive p-3" id="Z08">
						<input type="hidden" name="responses[z8][id]" value="8">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z8][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z8][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle" id="z8-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z8-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle" id="z8-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z8-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle" id="z8-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z8-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle in_response" id="z8-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z8-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z8][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle" id="z8-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z8-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle in_response" id="z8-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z8-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z8][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle" id="z8-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z8-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][agent_correction][]" class="align-middle in_response" id="z8-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z8-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z8][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][external_factor][]" class="align-middle" id="z8-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z8-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][external_factor][]" class="align-middle" id="z8-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z8-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][external_factor][]" class="align-middle" id="z8-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z8-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][external_factor][]" class="align-middle" id="z8-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z8-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z8][external_factor][]" class="align-middle" id="z8-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z8-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z16 -->
					<div class="tabcontent inactive p-3" id="Z16">
						<input type="hidden" name="responses[z16][id]" value="9">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z16][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z16][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle" id="z16-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z16-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle" id="z16-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z16-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle" id="z16-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z16-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle in_response" id="z16-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z16-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z16][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle" id="z16-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z16-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle in_response" id="z16-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z16-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z16][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle" id="z16-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z16-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][agent_correction][]" class="align-middle in_response" id="z16-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z16-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z16][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][external_factor][]" class="align-middle" id="z16-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z16-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][external_factor][]" class="align-middle" id="z16-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z16-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][external_factor][]" class="align-middle" id="z16-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z16-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][external_factor][]" class="align-middle" id="z16-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z16-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z16][external_factor][]" class="align-middle" id="z16-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z16-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z09 -->
					<div class="tabcontent inactive p-3" id="Z09">
						<input type="hidden" name="responses[z9][id]" value="10">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z9][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z9][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle" id="z9-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z9-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle" id="z9-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z9-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle" id="z9-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z9-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle in_response" id="z9-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z9-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z9][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle" id="z9-alist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z9-alist5">No rebuttal</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle in_response" id="z9-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z9-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z9][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle" id="z9-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z9-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][agent_correction][]" class="align-middle in_response" id="z9-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z9-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z9][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][external_factor][]" class="align-middle" id="z9-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z9-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][external_factor][]" class="align-middle" id="z9-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z9-elist2">Vici Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][external_factor][]" class="align-middle" id="z9-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z9-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][external_factor][]" class="align-middle" id="z9-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z9-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z9][external_factor][]" class="align-middle" id="z9-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z9-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z10 -->
					<div class="tabcontent inactive p-3" id="Z10">
						<input type="hidden" name="responses[z10][id]" value="11">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z10][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z10][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle" id="z10-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z10-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle" id="z10-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z10-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle" id="z10-alist2">
												<label class="align-middle mb-0 ml-2" for="z10-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle in_response" id="z10-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z10-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z10][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle in_response" id="z10-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z10-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z10][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle" id="z10-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z10-alist7">Stayed on the line for too long</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][agent_correction][]" class="align-middle in_response" id="z10-alist8" value="11">
												<label class="align-middle mb-0 ml-2" for="z10-alist8">Did not obtained/Incorrect detail</label>
												<div class="form-group hide">
													<input type="text" name="responses[z10][inc_detail]" class="form-control">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][external_factor][]" class="align-middle" id="z10-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z10-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][external_factor][]" class="align-middle" id="z10-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z10-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][external_factor][]" class="align-middle" id="z10-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z10-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z10][external_factor][]" class="align-middle" id="z10-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z10-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z11 -->
					<div class="tabcontent inactive p-3" id="Z11">
						<input type="hidden" name="responses[z11][id]" value="12">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z11][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z11][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][agent_correction][]" class="align-middle" id="z11-alist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z11-alist4">No acknowledgement</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][agent_correction][]" class="align-middle" id="z11-alist1" value="7">
												<label class="align-middle mb-0 ml-2" for="z11-alist1">Interrupting prospect</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][agent_correction][]" class="align-middle" id="z11-alist2" value="12">
												<label class="align-middle mb-0 ml-2" for="z11-alist2">Delayed response</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][agent_correction][]" class="align-middle in_response" id="z11-alist3" value="6">
												<label class="align-middle mb-0 ml-2" for="z11-alist3">Incorrect tagging</label>
												<div class="form-group hide">
													<label><strong>Enter correct dispo:</strong></label>
													<input type="text" name="responses[z11][inc_tagging]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][agent_correction][]" class="align-middle in_response" id="z11-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z11-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z11][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][agent_correction][]" class="align-middle" id="z11-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z11-alist7">Stayed on the line for too long</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][external_factor][]" class="align-middle" id="z11-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z11-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][external_factor][]" class="align-middle" id="z11-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z11-elist2">Vici Issue</label>
											</li>										
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][external_factor][]" class="align-middle" id="z11-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z11-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][external_factor][]" class="align-middle" id="z11-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z11-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z11][external_factor][]" class="align-middle" id="z11-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z11-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Z12 -->
					<div class="tabcontent inactive p-3" id="Z12">
						<input type="hidden" name="responses[z12][id]" value="13">
						<div class="row mb-2">
							<div class="col-md-12">
								<span class="btn btn-primary lolztp" 
								      data-user="{{ isset($user_id) ? $user_id : '' }}" 
								      data-name="{{ isset($emp->employee->full_name) ? $emp->employee->full_name : '(No record)' }}">
									LOL/ZTP
								</span>
								<button class="btn btn-danger">Call Ends</button>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Customer</div>
									<div class="card-body">
										<label>Statement (Question/Objection)</label>
										<textarea name="responses[z12][cust_statement]" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Comment</div>
									<div class="card-body">
										<label>Auditor's Comment</label>
										<textarea name="responses[z12][aud_comment]" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">Agent</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][agent_correction][]" class="align-middle in_response" id="z12-alist6" value="8">
												<label class="align-middle mb-0 ml-2" for="z12-alist6">Inappropriate response</label>
												<div class="form-group hide">
													<label><strong>Enter correct response:</strong></label>
													<input type="text" name="responses[z12][inapp_resp]" class="form-control">
												</div>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][agent_correction][]" class="align-middle" id="z12-alist7" value="10">
												<label class="align-middle mb-0 ml-2" for="z12-alist7">Stayed on the line for too long</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-secondary text-white">External Factors</div>
									<div class="card-body">
										<ul class="list-group">
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][external_factor][]" class="align-middle" id="z12-elist1" value="1">
												<label class="align-middle mb-0 ml-2" for="z12-elist1">Line Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][external_factor][]" class="align-middle" id="z12-elist2" value="2">
												<label class="align-middle mb-0 ml-2" for="z12-elist2">Vici Issue</label>
											</li>										
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][external_factor][]" class="align-middle" id="z12-elist3" value="3">
												<label class="align-middle mb-0 ml-2" for="z12-elist3">Webform Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][external_factor][]" class="align-middle" id="z12-elist4" value="4">
												<label class="align-middle mb-0 ml-2" for="z12-elist4">Script Issue</label>
											</li>
											<li class="list-group-item py-1">
												<input type="checkbox" name="responses[z12][external_factor][]" class="align-middle" id="z12-elist5" value="5">
												<label class="align-middle mb-0 ml-2" for="z12-elist5">Time Synch Error</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>

@endsection