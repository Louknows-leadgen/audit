@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<form action="{{ route('findings.store') }}" method="post">
					@csrf
					<input type="hidden" name="recording_id" value="{{ $recording_id }}">
					<div class="row">
						<div class="col-md-8 mx-auto">
							<h3>Auditor's Findings:</h3>
							<div class="form-group">
								<label>Correct Disposition?</label>
								<select class="custom-select" name="agent_dispo">
									<option value="25">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group d-none" id="dispo-select">
								<label>Dispositions</label>
								<select name="finding_dispositions[]" class="custom-select" multiple>
									@foreach($dispositions as $disposition)
										<option value="{{ $disposition->code }}">{{ $disposition->short_desc }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Agent/System issue?</label>
								<select class="custom-select" name="agnt_sys_issue">
									<option value="18">None</option>
									<option value="Agent">Agent</option>
									<option value="System">System</option>
								</select>
							</div>
							<div class="form-group d-none" id="agent-issue-select">
								<label>Agent Issues</label>
								<select name="finding_issues[]" class="custom-select" multiple>
									@foreach($agent_issues as $agent_issue)
										<option value="{{ $agent_issue->id }}">{{ $agent_issue->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group d-none" id="system-issue-select">
								<label>System Issues</label>
								<select name="finding_issues[]" class="custom-select" multiple>
									@foreach($system_issues as $system_issue)
										<option value="{{ $system_issue->id }}">{{ $system_issue->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Does this call have a ZT or LOL?</label>
								<select class="custom-select" name="ztp_lol">
									<option value="20">None</option>
									<option value="ZTP">ZT</option>
									<option value="LOL">LOL</option>
								</select>
							</div>
							<div class="form-group d-none" id="zt-select">
								<label>ZTP</label>
								<select name="finding_ztp_lols[]" class="custom-select" multiple>
									@foreach($ztps as $ztp)
										<option value="{{ $ztp->id }}">{{ $ztp->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group d-none" id="lol-select">
								<label>LOL</label>
								<select name="finding_ztp_lols[]" class="custom-select" multiple>
									@foreach($lols as $lol)
										<option value="{{ $lol->id }}">{{ $lol->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>QA Remarks</label>
								<textarea class="form-control" name="qa_remarks"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection