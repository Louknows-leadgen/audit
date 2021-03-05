<div class="row mb-3">
	<div class="col-md-12">
		<div class="box">
			<h5>Call Logs Options</h5>
			<hr>
			<form class="calllogs-search" action="{{ route('supervisor.index') }}" method="GET">
				<div class="form-group">
					<label>From</label>
					<input type="date" class="form-control" name="from" value="{{ !empty($from) ? $from : '' }}">
				</div>
				<div class="form-group">
					<label>To</label>
					<input type="date" class="form-control" name="to" value="{{ !empty($to) ? $to : '' }}">
				</div>
				<div class="form-group">
					<label>Server Id</label>
					<select class="custom-select" name="sid[]" multiple>
						@foreach($servers as $server)
						<option value="{{ $server->server_ip }}" {{ in_array($server->server_ip, $sid) ? 'selected' : '' }}>
							{{ $server->server_ip }}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Campaign</label>
					<select class="custom-select" name="campaign[]" multiple>
						@foreach($campaigns as $camp)
						<option value="{{ $camp->campaign }}" {{ in_array($camp->campaign, $campaign) ? 'selected' : '' }}>
							{{ $camp->campaign }}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Dispo</label>
					<select class="custom-select" name="dispo[]" multiple>
						@foreach($dispositions as $disposition)
						<option value="{{ $disposition->dispo }}" {{ in_array($disposition->dispo, $dispo) ? 'selected' : '' }}>
							{{ $disposition->dispo }}
						</option>
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