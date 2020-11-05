@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-11 px-0 mb-3">
			<div class="box-bg p-3">
				<div class="d-flex flex-wrap justify-content-around">
					<div><label class="font-weight-bolder">User ID:</label> 1123</div>
					<div><label class="font-weight-bolder">Name:</label> Lourence John Cabaluna</div>
					<div><label class="font-weight-bolder">Team Lead:</label> Josie Anthony Suico</div>
				</div>
				<div class="mt-3 text-center">
					<audio class="w-75" id="audio" style="outline: none;" controls>
						<source src="https://file-examples-com.github.io/uploads/2017/11/file_example_MP3_700KB.mp3" type="audio/wav">
					</audio>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container border">
	<div class="row">
		<div class="col-md-1 p-0">
			<div class="tab py-2 text-center btn-blue" data-content="Z01">Z01</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z02">Z02</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z03">Z03</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z04">Z04</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z05">Z05</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z06">Z06</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z07">Z07</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z08">Z08</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z16">Z16</div>			
			<div class="tab py-2 text-center btn-blue" data-content="Z09">Z09</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z10">Z10</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z11">Z11</div>
			<div class="tab py-2 text-center btn-blue" data-content="Z12">Z12</div>
		</div>
		<div class="col-md-11 p-0">
			<div class="box-bg">

				<!-- Z01 -->
				<div class="tabcontent inactive p-3" id="Z01">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist1">
											<label class="align-middle mb-0 ml-2" for="z1-alist1">No intro</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist2">
											<label class="align-middle mb-0 ml-2" for="z1-alist2">Delayed intro</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist3">
											<label class="align-middle mb-0 ml-2" for="z1-alist3">Did not proceed to z02</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist4">
											<label class="align-middle mb-0 ml-2" for="z1-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist5">
											<label class="align-middle mb-0 ml-2" for="z1-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist6">
											<label class="align-middle mb-0 ml-2" for="z1-alist6">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist7">
											<label class="align-middle mb-0 ml-2" for="z1-alist7">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist8">
											<label class="align-middle mb-0 ml-2" for="z1-alist8">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist9">
											<label class="align-middle mb-0 ml-2" for="z1-alist9">Call avoidance</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-alist10">
											<label class="align-middle mb-0 ml-2" for="z1-alist10">Stayed on the line for too long</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-elist1">
											<label class="align-middle mb-0 ml-2" for="z1-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-elist2">
											<label class="align-middle mb-0 ml-2" for="z1-elist2">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z1-elist3">
											<label class="align-middle mb-0 ml-2" for="z1-elist3">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z02 -->
				<div class="tabcontent inactive p-3" id="Z02">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist1">
											<label class="align-middle mb-0 ml-2" for="z2-alist1">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist2">
											<label class="align-middle mb-0 ml-2" for="z2-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist3">
											<label class="align-middle mb-0 ml-2" for="z2-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist4">
											<label class="align-middle mb-0 ml-2" for="z2-alist4">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist5">
											<label class="align-middle mb-0 ml-2" for="z2-alist5">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist6">
											<label class="align-middle mb-0 ml-2" for="z2-alist6">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist7">
											<label class="align-middle mb-0 ml-2" for="z2-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-alist8">
											<label class="align-middle mb-0 ml-2" for="z2-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-elist1">
											<label class="align-middle mb-0 ml-2" for="z2-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-elist2">
											<label class="align-middle mb-0 ml-2" for="z2-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-elist3">
											<label class="align-middle mb-0 ml-2" for="z2-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-elist4">
											<label class="align-middle mb-0 ml-2" for="z2-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z2-elist5">
											<label class="align-middle mb-0 ml-2" for="z2-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z03 -->
				<div class="tabcontent inactive p-3" id="Z03">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist1">
											<label class="align-middle mb-0 ml-2" for="z3-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist2">
											<label class="align-middle mb-0 ml-2" for="z3-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist3">
											<label class="align-middle mb-0 ml-2" for="z3-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist4">
											<label class="align-middle mb-0 ml-2" for="z3-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist5">
											<label class="align-middle mb-0 ml-2" for="z3-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist6">
											<label class="align-middle mb-0 ml-2" for="z3-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist7">
											<label class="align-middle mb-0 ml-2" for="z3-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-alist8">
											<label class="align-middle mb-0 ml-2" for="z3-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-elist1">
											<label class="align-middle mb-0 ml-2" for="z3-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-elist2">
											<label class="align-middle mb-0 ml-2" for="z3-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-elist3">
											<label class="align-middle mb-0 ml-2" for="z3-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-elist4">
											<label class="align-middle mb-0 ml-2" for="z3-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z3-elist5">
											<label class="align-middle mb-0 ml-2" for="z3-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z04 -->
				<div class="tabcontent inactive p-3" id="Z04">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist1">
											<label class="align-middle mb-0 ml-2" for="z4-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist2">
											<label class="align-middle mb-0 ml-2" for="z4-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist3">
											<label class="align-middle mb-0 ml-2" for="z4-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist4">
											<label class="align-middle mb-0 ml-2" for="z4-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist5">
											<label class="align-middle mb-0 ml-2" for="z4-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist6">
											<label class="align-middle mb-0 ml-2" for="z4-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist7">
											<label class="align-middle mb-0 ml-2" for="z4-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-alist8">
											<label class="align-middle mb-0 ml-2" for="z4-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-elist1">
											<label class="align-middle mb-0 ml-2" for="z4-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-elist2">
											<label class="align-middle mb-0 ml-2" for="z4-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-elist3">
											<label class="align-middle mb-0 ml-2" for="z4-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-elist4">
											<label class="align-middle mb-0 ml-2" for="z4-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z4-elist5">
											<label class="align-middle mb-0 ml-2" for="z4-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z05 -->
				<div class="tabcontent inactive p-3" id="Z05">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist4">
											<label class="align-middle mb-0 ml-2" for="z5-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist1">
											<label class="align-middle mb-0 ml-2" for="z5-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist2">
											<label class="align-middle mb-0 ml-2" for="z5-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist3">
											<label class="align-middle mb-0 ml-2" for="z5-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist5">
											<label class="align-middle mb-0 ml-2" for="z5-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist6">
											<label class="align-middle mb-0 ml-2" for="z5-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist7">
											<label class="align-middle mb-0 ml-2" for="z5-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-alist8">
											<label class="align-middle mb-0 ml-2" for="z5-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-elist1">
											<label class="align-middle mb-0 ml-2" for="z5-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-elist2">
											<label class="align-middle mb-0 ml-2" for="z5-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-elist3">
											<label class="align-middle mb-0 ml-2" for="z5-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-elist4">
											<label class="align-middle mb-0 ml-2" for="z5-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z5-elist5">
											<label class="align-middle mb-0 ml-2" for="z5-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z06 -->
				<div class="tabcontent inactive p-3" id="Z06">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist4">
											<label class="align-middle mb-0 ml-2" for="z6-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist1">
											<label class="align-middle mb-0 ml-2" for="z6-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist2">
											<label class="align-middle mb-0 ml-2" for="z6-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist3">
											<label class="align-middle mb-0 ml-2" for="z6-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist5">
											<label class="align-middle mb-0 ml-2" for="z6-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist6">
											<label class="align-middle mb-0 ml-2" for="z6-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist7">
											<label class="align-middle mb-0 ml-2" for="z6-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-alist8">
											<label class="align-middle mb-0 ml-2" for="z6-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-elist1">
											<label class="align-middle mb-0 ml-2" for="z6-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-elist2">
											<label class="align-middle mb-0 ml-2" for="z6-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-elist3">
											<label class="align-middle mb-0 ml-2" for="z6-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-elist4">
											<label class="align-middle mb-0 ml-2" for="z6-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z6-elist5">
											<label class="align-middle mb-0 ml-2" for="z6-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z07 -->
				<div class="tabcontent inactive p-3" id="Z07">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist4">
											<label class="align-middle mb-0 ml-2" for="z7-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist1">
											<label class="align-middle mb-0 ml-2" for="z7-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist2">
											<label class="align-middle mb-0 ml-2" for="z7-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist3">
											<label class="align-middle mb-0 ml-2" for="z7-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist5">
											<label class="align-middle mb-0 ml-2" for="z7-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist6">
											<label class="align-middle mb-0 ml-2" for="z7-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist7">
											<label class="align-middle mb-0 ml-2" for="z7-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-alist8">
											<label class="align-middle mb-0 ml-2" for="z7-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-elist1">
											<label class="align-middle mb-0 ml-2" for="z7-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-elist2">
											<label class="align-middle mb-0 ml-2" for="z7-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-elist3">
											<label class="align-middle mb-0 ml-2" for="z7-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-elist4">
											<label class="align-middle mb-0 ml-2" for="z7-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z7-elist5">
											<label class="align-middle mb-0 ml-2" for="z7-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z08 -->
				<div class="tabcontent inactive p-3" id="Z08">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist4">
											<label class="align-middle mb-0 ml-2" for="z8-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist1">
											<label class="align-middle mb-0 ml-2" for="z8-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist2">
											<label class="align-middle mb-0 ml-2" for="z8-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist3">
											<label class="align-middle mb-0 ml-2" for="z8-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist5">
											<label class="align-middle mb-0 ml-2" for="z8-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist6">
											<label class="align-middle mb-0 ml-2" for="z8-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist7">
											<label class="align-middle mb-0 ml-2" for="z8-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-alist8">
											<label class="align-middle mb-0 ml-2" for="z8-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-elist1">
											<label class="align-middle mb-0 ml-2" for="z8-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-elist2">
											<label class="align-middle mb-0 ml-2" for="z8-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-elist3">
											<label class="align-middle mb-0 ml-2" for="z8-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-elist4">
											<label class="align-middle mb-0 ml-2" for="z8-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z8-elist5">
											<label class="align-middle mb-0 ml-2" for="z8-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z16 -->
				<div class="tabcontent inactive p-3" id="Z16">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist4">
											<label class="align-middle mb-0 ml-2" for="z16-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist1">
											<label class="align-middle mb-0 ml-2" for="z16-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist2">
											<label class="align-middle mb-0 ml-2" for="z16-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist3">
											<label class="align-middle mb-0 ml-2" for="z16-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist5">
											<label class="align-middle mb-0 ml-2" for="z16-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist6">
											<label class="align-middle mb-0 ml-2" for="z16-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist7">
											<label class="align-middle mb-0 ml-2" for="z16-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-alist8">
											<label class="align-middle mb-0 ml-2" for="z16-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-elist1">
											<label class="align-middle mb-0 ml-2" for="z16-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-elist2">
											<label class="align-middle mb-0 ml-2" for="z16-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-elist3">
											<label class="align-middle mb-0 ml-2" for="z16-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-elist4">
											<label class="align-middle mb-0 ml-2" for="z16-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z16-elist5">
											<label class="align-middle mb-0 ml-2" for="z16-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z09 -->
				<div class="tabcontent inactive p-3" id="Z09">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist4">
											<label class="align-middle mb-0 ml-2" for="z9-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist1">
											<label class="align-middle mb-0 ml-2" for="z9-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist2">
											<label class="align-middle mb-0 ml-2" for="z9-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist3">
											<label class="align-middle mb-0 ml-2" for="z9-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist5">
											<label class="align-middle mb-0 ml-2" for="z9-alist5">No rebuttal</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist6">
											<label class="align-middle mb-0 ml-2" for="z9-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist7">
											<label class="align-middle mb-0 ml-2" for="z9-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-alist8">
											<label class="align-middle mb-0 ml-2" for="z9-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-elist1">
											<label class="align-middle mb-0 ml-2" for="z9-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-elist2">
											<label class="align-middle mb-0 ml-2" for="z9-elist2">Vici Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-elist3">
											<label class="align-middle mb-0 ml-2" for="z9-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-elist4">
											<label class="align-middle mb-0 ml-2" for="z9-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z9-elist5">
											<label class="align-middle mb-0 ml-2" for="z9-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z10 -->
				<div class="tabcontent inactive p-3" id="Z10">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist4">
											<label class="align-middle mb-0 ml-2" for="z10-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist1">
											<label class="align-middle mb-0 ml-2" for="z10-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist2">
											<label class="align-middle mb-0 ml-2" for="z10-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist3">
											<label class="align-middle mb-0 ml-2" for="z10-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist6">
											<label class="align-middle mb-0 ml-2" for="z10-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist7">
											<label class="align-middle mb-0 ml-2" for="z10-alist7">Stayed on the line for too long</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-alist8">
											<label class="align-middle mb-0 ml-2" for="z10-alist8">Did not obtained/Incorrect detail</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-elist1">
											<label class="align-middle mb-0 ml-2" for="z10-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-elist3">
											<label class="align-middle mb-0 ml-2" for="z10-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-elist4">
											<label class="align-middle mb-0 ml-2" for="z10-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z10-elist5">
											<label class="align-middle mb-0 ml-2" for="z10-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z11 -->
				<div class="tabcontent inactive p-3" id="Z11">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-alist4">
											<label class="align-middle mb-0 ml-2" for="z11-alist4">No acknowledgement</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-alist1">
											<label class="align-middle mb-0 ml-2" for="z11-alist1">Interrupting prospect</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-alist2">
											<label class="align-middle mb-0 ml-2" for="z11-alist2">Delayed response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-alist3">
											<label class="align-middle mb-0 ml-2" for="z11-alist3">Incorrect tagging</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-alist6">
											<label class="align-middle mb-0 ml-2" for="z11-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-alist7">
											<label class="align-middle mb-0 ml-2" for="z11-alist7">Stayed on the line for too long</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-elist1">
											<label class="align-middle mb-0 ml-2" for="z11-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-elist2">
											<label class="align-middle mb-0 ml-2" for="z11-elist2">Vici Issue</label>
										</li>										
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-elist3">
											<label class="align-middle mb-0 ml-2" for="z11-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-elist4">
											<label class="align-middle mb-0 ml-2" for="z11-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z11-elist5">
											<label class="align-middle mb-0 ml-2" for="z11-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Z12 -->
				<div class="tabcontent inactive p-3" id="Z12">
					<div class="row mb-2">
						<div class="col-md-12">
							<button class="btn btn-primary">LOL/ZTP</button>
							<button class="btn btn-danger">Call Ends</button>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Customer</div>
								<div class="card-body">
									<label>Statement (Question/Objection)</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Comment</div>
								<div class="card-body">
									<label>Auditor's Comment</label>
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">Agent</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-alist6">
											<label class="align-middle mb-0 ml-2" for="z12-alist6">Inappropriate response</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-alist7">
											<label class="align-middle mb-0 ml-2" for="z12-alist7">Stayed on the line for too long</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-secondary text-white">External Factors</div>
								<div class="card-body">
									<ul class="list-group">
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-elist1">
											<label class="align-middle mb-0 ml-2" for="z12-elist1">Line Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-elist2">
											<label class="align-middle mb-0 ml-2" for="z12-elist2">Vici Issue</label>
										</li>										
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-elist3">
											<label class="align-middle mb-0 ml-2" for="z12-elist3">Webform Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-elist4">
											<label class="align-middle mb-0 ml-2" for="z12-elist4">Script Issue</label>
										</li>
										<li class="list-group-item py-1">
											<input type="checkbox" name="" class="align-middle" id="z12-elist5">
											<label class="align-middle mb-0 ml-2" for="z12-elist5">Time Synch Error</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection