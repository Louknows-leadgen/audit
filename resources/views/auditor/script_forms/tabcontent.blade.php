<div class="mt-3">
	<h5>Script code: <strong>{{ $script->name }}</strong></h5>
	<input type="hidden" name="{{ $script->name }}[recording_id]" value="{{ $calllog->recording_id }}">
	<input type="hidden" name="{{ $script->name }}[script_code]" value="{{ $script->code }}">
	<ol>
		<li>
			<div class="form-group">
				<label>Customer's Statement (question/objection)</label>
				<textarea class="form-control" name="{{$script->name}}[cust_statement]"></textarea>
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Acknowledge</label>
				<div class="d-flex justify-content-around w-25">
					<div class="custom-control custom-radio">
						<input type="radio" 
							   class="custom-control-input" 
							   name="{{$script->name}}[acknowledge]" 
							   id="{{$script->name}}-{{$calllog->ctr}}-ack-yes" 
							   value="Yes">
						<label class="custom-control-label" 
							   for="{{$script->name}}-{{$calllog->ctr}}-ack-yes">Yes</label>
					</div>
					<div class="custom-control custom-radio">
						<input type="radio" 
							   class="custom-control-input" 
							   name="{{$script->name}}[acknowledge]" 
							   id="{{$script->name}}-{{$calllog->ctr}}-ack-no" 
							   value="No">
						<label class="custom-control-label" 
							   for="{{$script->name}}-{{$calllog->ctr}}-ack-no">No</label>
					</div>
				</div>
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Agent's response</label>
				<input type="text" class="form-control" name="{{$script->name}}[agent_response]">
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Agent's response speed</label>
				<input type="number" class="form-control" name="{{$script->name}}[agent_response_speed]">
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Correct response</label>
				<input type="text" class="form-control" name="{{$script->name}}[correct_response]" placeholder="Correct key if agent was incorrect. Blank otherwise.">
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Customer details</label>
				<textarea class="form-control" name="{{$script->name}}[customer_details]" placeholder="Customer's details if agent is incorrect. Blank otherwise."></textarea>
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Agent input</label>
				<textarea class="form-control" name="{{$script->name}}[agent_input]" placeholder="Agent's input if agent is incorrect. Blank otherwise."></textarea>
			</div>
		</li>
		<li>
			<div class="form-group">
				<label>Comment</label>
				<textarea class="form-control" name="{{$script->name}}[comment]"></textarea>
			</div>
		</li>
	</ol>
	<div class="d-flex justify-content-end">
		@if($script->id > 1)
			<span class="left-chevron" data-tab="{{ $scripts[$index-1]->name }}-{{ $calllog->ctr }}">{{ $scripts[$index-1]->name }}</span>
		@endif

		@if($script->id > 1 && $script->id < 14)
			<span class="mx-2">|</span>
		@endif

		@if($script->id < 14 )
			<span class="right-chevron" data-tab="{{ $scripts[$index+1]->name }}-{{ $calllog->ctr }}">{{ $scripts[$index+1]->name }}</span>
		@endif
	</div>
</div>