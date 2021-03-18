@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="box">
			<form id="audit-count-form" action="{{ route('auditor.count-audits') }}" method="get">
				<input type="hidden" name="userid" value="{{ $userid }}">
				<div class="form-group">
					<label>Call Date</label>
					<input type="date" class="form-control" name="date" required>
				</div>
				
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value=" " name="dispo[]" checked>(Blank)
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="A" name="dispo[]" checked>A
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="AA" name="dispo[]" checked>AA
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="B" name="dispo[]" checked>B
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="CBHOLD" name="dispo[]" checked>CBHOLD
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="DC" name="dispo[]" checked>DC
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="DEAD" name="dispo[]" checked>DEAD
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="DNC" name="dispo[]" checked>DNC
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="DTO" name="dispo[]" checked>DTO
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="DUMP" name="dispo[]" checked>DUMP
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="HUP" name="dispo[]" checked>HUP
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="InsHUP" name="dispo[]" checked>InsHUP
					</label>
				</div>


				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="Lang" name="dispo[]" checked>Lang
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="NA" name="dispo[]" checked>NA
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="NI" name="dispo[]" checked>NI
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="NQ" name="dispo[]" checked>NQ
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="Prank" name="dispo[]" checked>Prank
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="RD" name="dispo[]" checked>RD
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="RING" name="dispo[]" checked>RING
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="ROBOT" name="dispo[]" checked>ROBOT
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="TRHUP" name="dispo[]" checked>TRHUP
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="TrSuc" name="dispo[]" checked>TrSuc
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="VM" name="dispo[]" checked>VM
					</label>
				</div>
				<div class="form-check-inline" style="width: 78px">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="WRNGN" name="dispo[]" checked>WRNGN
					</label>
				</div>

				<div class="mt-3">
					<input type="submit" value="Count" class="btn btn-primary">
				</div>
			</form>
			<hr>
			<div id="audit-count-cntr">
				<!-- Populate through jquery -->
			</div>
		</div>
	</div>
</div>

@endsection