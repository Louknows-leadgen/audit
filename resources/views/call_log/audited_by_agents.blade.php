@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<select class="form-control">
					@foreach($agents as $agent)
						<option value="{{ $agent->user }}">{{ $agent->user }}</option>
					@endforeach
				</select>
				<table>
					<thead>
						<tr>
							<th>Agent ID</th>
							<th>Recording ID</th>
							<th>Phone Number</th>
							<th>Auditor</th>
							<th>Findings</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="5">Please select Agent ID</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection