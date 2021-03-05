@extends('layouts.app')


@section('content')
	<div class="panel border-left-success h-100">
		<div class="panel-body">
			<div class="row no-gutter align-items-center">
				<div class="mr-2">
					<div class="text-xs font-weight-bold text-success text-uppercase"> Create </div>
					<div class="h5 font-weight-bold text-gray-800">
						<a href="{{ route('register') }}">User</a>
					</div>
				</div>
				<div class="col-auto margin-left-auto">
					<i class="fa fa-user-plus fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
@endsection