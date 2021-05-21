@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-10 mx-auto">
		<div class="box" style="min-height: 30rem">
			<div class="row mb-3">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="nav-item"><a class="nav-link active">Search Call</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ route('ops.audited-list') }}">Audited Calls</a></li>
					</ul>
				</div>
			</div>
			<div class="row mb-3">
				<form class="col-md-6" action="{{ route('ops.search') }}" method="get" id="op-call-search">
					<div class="d-flex" style="gap: 1rem;">
						<input type="text" class="form-control" name="search" required>
						<select class="form-control" name="search-type">
							<option value="1">phone</option>
							<option value="2">recording id</option>
						</select>
						<button class="btn btn-primary">Search</button>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div id="op-call-search-result">
						<div class="text-center">
							<span>No search calls</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection