@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-3">
			@include('supervisor.search-section')
		</div>
		<div class="col-md-8">
			@include('supervisor.search_result-section')
		</div>
	</div>

	<div class="gray-bg">
		<div class="d-flex flex-column align-items-center justify-content-center h-100">
			<div class="text-light">Please wait</div>
			<div>
				<div class="spinner-grow text-info"></div>
				<div class="spinner-grow text-info"></div>
				<div class="spinner-grow text-info"></div>
			</div>
		</div>
	</div>
@endsection