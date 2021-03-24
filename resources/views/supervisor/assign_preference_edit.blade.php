@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div>
				<select class="form-control">
					@foreach($teams as $team)
						<option value="{{ $team->id }}" {{ $team->id == $rule->team_id ? 'selected' : '' }}>
							{{ $team->name }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>

@endsection