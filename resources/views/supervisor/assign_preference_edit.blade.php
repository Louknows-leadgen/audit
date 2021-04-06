@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box pb-5">
				<form action="{{ route('supervisor.assign_preference_update',['id'=>$rule->id]) }}" method="post">
					@csrf
					<h4>Call Assignment Preference</h4>
					<hr>
					<h5>Rule Name</h5>
					<div class="row">
						<div class="col-md-4 col-sm-12 mb-3">
							<input type="text" name="name" class="form-control" value="{{ $rule->name }}" required>
						</div>
					</div>
					<h5>Teams</h5>
					<div class="row">
						<div class="col-md-4 col-sm-12 mb-3">
							<select class="form-control" name="team_id">
								@foreach($teams as $team)
									<option value="{{ $team->id }}" {{ $team->id == $rule->team_id ? 'selected' : '' }}>
										{{ $team->name }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<hr>
					<h5 class="mb-3">Dispositions</h5>
					<p>Leave as blank if you want to assign all records for each disposition. Place 0 if you want to exclude a disposition filter.</p>
					<div class="d-flex flex-wrap" style="gap: 1rem">
						@foreach($dispositions as $dispo)
							<div class="form-group" style="width: 10ch">
								<label>{{ empty(trim($dispo->short_name)) ? '(BLANK)' : $dispo->short_name }}</label>
								<input type="number" name="dispo[{{ $dispo->id }}]" class="form-control" style="width: 10ch" value="{{ $dispo_list[$dispo->id] == -1 ? '' : $dispo_list[$dispo->id] }}">
							</div>
						@endforeach
					</div>
					<hr>
					<div class="d-flex justify-content-end">
						<div class="d-flex" style="gap: 1rem;">
							<span class="btn btn-secondary" onclick="window.history.back();">Cancel</span>
							<input class="btn btn-primary" type="submit" value="Update">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection