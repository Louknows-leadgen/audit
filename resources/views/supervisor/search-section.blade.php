<div class="row mb-3">
	<div class="col-md-12">
		<div class="box">
			<h5>Call Logs Options</h5>
			<hr>
			<form class="calllogs-search" action="{{ route('supervisor.search_calls') }}" method="GET">
				<div class="form-group">
					<label>From</label>
					<input type="text" class="form-control datetime" name="from" value="{{ $from_dt }}">
				</div>
				<div class="form-group">
					<label>To</label>
					<input type="text" class="form-control datetime" name="to" value="{{ $to_dt }}">
				</div>
				<div class="form-group">
					<label>Server Id</label>
					<select class="custom-select" name="sid" multiple>
						@foreach($servers as $server)
						<option value="{{ $server->name }}" selected>{{ $server->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Campaign</label>
					<select class="custom-select" name="campaign" multiple>
						@foreach($campaigns as $campaign)
						<option value="{{ $campaign->name }}" selected>{{ $campaign->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Dispo</label>
					<select class="custom-select" name="dispo" multiple>
						@foreach($dispositions as $dispo)
						<option value="{{ $dispo->name }}" selected>{{ $dispo->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary">Search</button>
				</div>
			</form>
		</div>
	</div>
</div>