<div class="gray-bg aud-modal" data-modal="{{ $calllog->ctr }}">
	<div class="modal-content">
		<span class="close">&times;</span>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 mb-3">
					<div class="box">
						<div class="row">
							<div class="col-md-3 my-auto">
								<strong>Recording ID:</strong>
								<span>{{ $calllog->recording_id }}</span>
							</div>
							<div class="col-md-3 my-auto">
								<strong>Phone:</strong>
								<span>{{ $calllog->phone_number }}</span>
							</div>
							<div class="col-md-6 my-auto">
								<audio class="w-100" controls>
									<source src="https://file-examples.com/wp-content/uploads/2017/11/file_example_WAV_1MG.wav" type="audio/wav">
								</audio>
							</div>
							<div class="col-md-3">
								<button class="btn btn-primary submit_audit">Submit</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 mb-3"> 
					<div class="box"> 
						<!-- Tabs -->
						@include('auditor.script_forms.tabs')
						<!-- Tab panes -->
						<form class="audit_form" action="{{ route('auditor.submit_audit') }}" method="post">
							<div class="tab-content">
								@foreach($scripts as $index => $script)
									@php
										$recording_id = $calllog->recording_id;
										$script_code = $script->code;
										$rs = get_recording_script($script_code, $recording_id);
									@endphp

									<div class="tab-pane container @if($script->code == 1) active @endif" 
										 id="{{ $script->name }}-{{ $calllog->ctr }}">
										@include('auditor.script_forms.tabcontent')
									</div>
								@endforeach
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>