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
								<select class="custom-select" name="correct_dispo">
									@foreach($dispositions as $disposition)
										<option value="{{ $disposition->code }}">{{ $disposition->short_desc }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Agent/System issue?</label>
								<select class="custom-select" name="agnt_sys_issue">
									<option>Agent</option>
									<option>System</option>
								</select>
							</div>
							<div class="form-group">
								<label>Does this call have a ZT or LOL?</label>
								<select class="custom-select" name="zt_lol">
									<option>ZT</option>
									<option>LOL</option>
								</select>
							</div>
							<div class="form-group">
								<label>General Observation</label>
								<select class="custom-select" name="gen_obsrv">
									@foreach($observations as $observation)
										<option value="{{ $observation->code }}">{{ $observation->name }}</option>
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