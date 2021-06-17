@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="card p-4">
			<h3 class="d-flex justify-content-center mb-4">Incident Report</h3>
			<form>
				<fieldset class="border p-2">
					<legend class="w-auto bg-primary text-white pl-2 pr-2 rounded"><small>Agent Info</small></legend>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Agent Id</label>
								<input type="text" name="agent_id" class="form-control" value="2845">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Agent Name</label>
								<input type="text" name="agent_name" class="form-control" value="Sam Gilson">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Team Lead Email</label>
								<input type="email" name="tl_email" class="form-control" value="kathlyn@email.com">
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset class="border p-2 mt-4">
					<legend class="w-auto bg-primary text-white pl-2 pr-2 rounded"><small>Recording Info</small></legend>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Source</label>
								<select class="form-control">
									<option>Internal</option>
									<option>Flagged</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Call Date</label>
								<input type="date" name="agent_name" class="form-control" value="2021-06-14">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Evaluation Date</label>
								<input type="date" name="agent_name" class="form-control" value="2021-06-14">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Vici Dispo</label>
								<input type="text" name="dispo" class="form-control" value="DNC">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">BTN (phone)</label>
								<input type="text" name="btn" class="form-control" value="6239128385">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Duration (min)</label>
								<input type="number" name="duration" class="form-control" value="11">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Evaluator</label>
								<input type="text" name="evaluator" class="form-control" value="Q.A Section" readonly>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset class="border p-2 mt-4">
					<legend class="w-auto bg-primary text-white pl-2 pr-2 rounded"><small>Assessment</small></legend>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Offense</label>
								<select class="form-control" name="offense">
									<option>L.O.L - Call avoidance</option>
									<option>L.O.L - Escalated the call to the SUP without customer request</option>
									<option>L.O.L - Transferred the call inappropriately</option>
									<option>L.O.L - Did not brand the call</option>
									<option>L.O.L - Inappropriate response</option>
									<option>L.O.L - Unprofessional</option>
									<option>L.O.L - Making disparaging remarks</option>
									<option>L.O.L - Speaking in Vernacular</option>
									<option>L.O.L - Tagging the call incorrectly on the webform</option>
									<option>L.O.L - Tagging the call incorrectly on vicidial</option>
									<option>L.O.L - Submitting webform more than once</option>
									<option>L.O.L - Aggressive Selling</option>
									<option>L.O.L - Script</option>
									<option>L.O.L - Webform Information</option>
									<option>L.O.L - Language Barrier/Confused</option>
									<option>ZTP - DNC</option>
									<option>ZTP - ROBO call</option>
									<option>ZTP - Call Riding</option>
									<option>ZTP - Score Manipulation</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Sanction</label>
								<select class="form-control" name="sanction">
									<option>For Coaching</option>
									<option>Documented Verbal Warning</option>
									<option>1st Written Warning</option>
									<option>1st to 3 days suspension</option>
									<option>2nd to 3 days suspension</option>
									<option>3 days suspension</option>
									<option>1st to 5 days suspension</option>
									<option>2nd to 5 days suspension</option>
									<option>5 days suspension</option>
									<option>1st to End of Contract</option>
									<option>2nd to End of Contract</option>
									<option>Final Written Warning</option>
									<option>End of Contract</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="font-weight-bold">Progress of Offense</label>
								<select class="form-control" name="offense_progress">
									<option>For Coaching</option>
									<option>Documented Verbal Warning</option>
									<option>1st Written Warning</option>
									<option>1st to 3 days suspension</option>
									<option>2nd to 3 days suspension</option>
									<option>3 days suspension</option>
									<option>1st to 5 days suspension</option>
									<option>2nd to 5 days suspension</option>
									<option>5 days suspension</option>
									<option>1st to End of Contract</option>
									<option>2nd to End of Contract</option>
									<option>Final Written Warning</option>
									<option>End of Contract</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="font-weight-bold">Call Synopsis/Note</label>
								<textarea class="form-control" name="synopsis" rows="5"></textarea>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="d-flex justify-content-end">
							<input type="submit" class="btn btn-lg btn-success" value="Submit">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection