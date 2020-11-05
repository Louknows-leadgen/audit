@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box mb-3">
				<audio class="w-100" id="audio" style="outline: none;" controls>
					<source src="https://file-examples-com.github.io/uploads/2017/11/file_example_MP3_700KB.mp3" type="audio/wav">
				</audio>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="au-form-grid">
				<div id="tab">
					<div class="tab py-3 text-center btn-blue" data-content="Z01">Z01</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z02">Z02</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z03">Z03</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z04">Z04</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z16">Z16</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z05">Z05</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z06">Z06</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z07">Z07</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z15">Z15</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z08">Z08</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z09">Z09</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z10">Z10</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z11">Z11</div>
					<div class="tab py-3 text-center btn-blue" data-content="Z12">Z12</div>
				</div>
				<div class="d-flex box-bg">
					<div class="m-auto tabcontent active" id="init-display">No Selected Script</div>
					<div class="tabcontent inactive p-3" id="Z01">
						<div class="card mb-3">
							<div class="card-header bg-success text-white">Customer</div>
							<div class="card-body">
								<label>Statement (Question/Objection)</label>
								<input type="text" name="" class="form-control">
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header bg-danger text-white">Agent</div>
							<div class="card-body">
								<div class="form-group">
									<label>Agent Response</label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="form-group">
									<label>Speed</label>
									<input type="number" name="" class="form-control">
								</div>
								<div class="form-group">
									<label>Correct Response</label>
									<input type="text" name="" class="form-control">
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header bg-primary text-white">Information</div>
							<div class="card-body">
								<div class="form-group">
									<label>Customer Details</label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="form-group">
									<label>Agent Input</label>
									<input type="number" name="" class="form-control">
								</div>
								<div class="form-group">
									<label>Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="tabcontent inactive p-3" id="Z02">
						test Z02
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection