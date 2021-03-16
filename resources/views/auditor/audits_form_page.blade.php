@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="box">
			<form>
				<div class="form-group">
					<label>Call Date</label>
					<input type="date" class="form-control">
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="" name="dispo[]">Dispo 1
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="" name="dispo[]">Dispo 2
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="" name="dispo[]">Dispo 3
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" value="" name="dispo[]">Dispo 4
					</label>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection