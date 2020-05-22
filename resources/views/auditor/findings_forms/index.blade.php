<div class="row">
	<div class="col-md-12">
		<div class="box" style="height: 500px; overflow-y: scroll;">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<h3>Auditor's Findings:</h3>
					<div class="form-group">
						<label>Agent Disposition</label>
						<select class="custom-select">
							@foreach($dispositions as $disposition)
								<option value="{{ $disposition->code }}">{{ $disposition->short_desc }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Correct Disposition</label>
						<select class="custom-select">
							@foreach($dispositions as $disposition)
								<option value="{{ $disposition->code }}">{{ $disposition->short_desc }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Agent/System issue?</label>
						<select class="custom-select">
							<option>Agent</option>
							<option>System</option>
						</select>
					</div>
					<div class="form-group">
						<label>Does this call have a ZT or LOL?</label>
						<select class="custom-select">
							<option>ZT</option>
							<option>LOL</option>
						</select>
					</div>
					<div class="form-group">
						<label>General Observation</label>
						<select class="custom-select">
							@foreach($observations as $observation)
								<option value="{{ $observation->code }}">{{ $observation->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>QA Remarks</label>
						<textarea class="form-control"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>