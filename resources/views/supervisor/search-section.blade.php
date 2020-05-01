<div class="row mb-3">
	<div class="col-md-12">
		<div class="box">
			<h5>Call Logs Options</h5>
			<hr>
			{{ $curr_dt }}
			<div class="form-group">
				<label>From</label>
				<input type="text" class="form-control datetime" name="from">
			</div>
			<div class="form-group">
				<label>Server Id</label>
				<select class="custom-select" name="sid">
					@foreach($servers as $server)
					<option value="{{ $server->code }}">{{ $server->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Campaign</label>
				<select class="custom-select" name="sid">
					@foreach($campaigns as $campaign)
					<option value="{{ $campaign->code }}">{{ $campaign->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Dispo</label>
				<select class="custom-select" name="sid">
					@foreach($dispositions as $dispo)
					<option value="{{ $dispo->code }}">{{ $dispo->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>