@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<h4>Auto Assign Preference</h4>
				<hr>
				<a href="{{ route('supervisor.assign_preference_new') }}">New</a>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="thead-light">
							<tr class="text-center">
								<th>Assignment Name</th>
								<th>Created By</th>
								<th colspan="2"></th>
							</tr>
						</thead>
						<tbody>
							@if(count($rules_list))
								@foreach($rules_list as $rule)
									<tr class="text-center">
										<td>{{ $rule->name }}</td>
										<td>{{ $rule->created_by_user->email }}</td>
										<td>
											<a class="btn btn-primary" href="{{ route('supervisor.assign_preference_edit',['id'=>$rule->id]) }}">Edit</button>
										</td>
										<td></td>
									</tr>
								@endforeach
							@else
									<tr>
										<td colspan="4">No list found</td>
									</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection