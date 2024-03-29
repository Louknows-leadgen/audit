@extends('layouts.app')

@section('content')



<div class="container">
	<div class="box">
		<form id="hourly-form" action="{{ route('report.auditors_hourly_content') }}" method="post">
			@csrf
			<h5>Auditor Hourly</h5>
			<div class="row">
				<div class="col-md-4 mb-3">
					<select name="auditor" class="form-control" required>
						@foreach($auditors as $auditor)
							<option value="{{ $auditor->id }}"> {{ $auditor->name }} </option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4 mb-3">
					<input type="date" class="form-control" name="audit_dt">
					<p class="text-danger mb-0 dt-notif"></p>
				</div>
				<div class="col-md-4">
					<input type="submit" value="Search" class="btn btn-primary">
				</div>
			</div>
		</form>
		<hr>
		<div id="hourly-content">
			
		</div>
	</div>
</div>



@endsection