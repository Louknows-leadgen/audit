@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="box">
				<h5>My Call Logs:</h5>
				<table class="table table-bordered table-sm table-responsive w-100 d-block d-md-table">
					<thead class="thead-dark">
						<tr>
							<th>Record ID</th>
							<th>Agent ID</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($calllogs as $calllog)
							<tr>
								<td>{{ $calllog->recording_id }}</td>
								<td>{{ $calllog->user }}</td>
								<td>{{ $calllog->phone_number }}</td>
								<td><button class="btn btn-primary">Start Audit</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="gray-bg">
		<div class="modal-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 mb-3">
						<div class="box">
							<div class="row">
								<div class="col-md-3 my-auto">
									<strong>Recording ID:</strong>
									<span>20082137</span>
								</div>
								<div class="col-md-3 my-auto">
									<strong>Phone:</strong>
									<span>9282559093</span>
								</div>
								<div class="col-md-6 my-auto">
									<audio class="w-100" controls>
										<source src="https://file-examples.com/wp-content/uploads/2017/11/file_example_WAV_1MG.wav" type="audio/wav">
									</audio>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 mb-3"> 
						<div class="box"> 
							<!-- Tabs -->
							@include('auditor.script_forms.tabs')
							<!-- Tab panes -->
							<div class="tab-content">
								@foreach($scripts as $index => $script)
									<div class="tab-pane container @if($script->code == 1) active @endif" 
										 id="{{ $script->name }}">
										@include('auditor.script_forms.tabcontent')
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection