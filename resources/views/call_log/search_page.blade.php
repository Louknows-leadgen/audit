@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<form action="{{ route('call.search') }}" method="get">
					<div class="form-group">
						<label>Phone Number:</label>
						<input type="number" name="phone_number" class="form-control" value="{{ $phone_number }}" required>
					</div>
					<div>
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
				<hr class="my-3">
				<div class="table-responsive">
					@if(count($calllogs))
						<table class="table table-bordered">
							<thead class="thead-light">
								<tr class="text-center">
									<th>Phone Number</th>
									<th>User</th>
									<th>Disposition</th>
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($calllogs as $calllog)
								<tr class="text-center">
									<td>{{ $calllog->phone_number }}</td>
									<td>{{ $calllog->user }}</td>
									<td>{{ $calllog->dispo }}</td>
									<td>
										<form action="{{ route('call.tag') }}" method="post">
											@csrf
											<input type="hidden" name="ctr" class="form-control" value="{{ $calllog->ctr }}">
											<input type="hidden" name="audit_type" class="form-control" value="flag">
											<input type="submit" value="Flag" class="btn btn-warning">
										</form>
									</td>
									<td>
										<form action="{{ route('call.tag') }}" method="post">
											@csrf
											<input type="hidden" name="ctr" class="form-control" value="{{ $calllog->ctr }}">
											<input type="hidden" name="audit_type" class="form-control" value="request">
											<input type="submit" value="Request" class="btn btn-info">
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div>
							No Results Found
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>


@endsection