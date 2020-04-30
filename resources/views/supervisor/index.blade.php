@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-3">
			@include('supervisor.search-section')
		</div>
		<div class="col-md-8">
			@include('supervisor.searchresult-section')
		</div>
	</div>
@endsection