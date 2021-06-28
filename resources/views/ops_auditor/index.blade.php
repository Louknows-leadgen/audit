@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="box">
				<h5>QA Audited Call Logs:</h5>
				<div class="table-responsive">
					<table class="table table-bordered table-sm w-100 d-block d-md-table" style="min-width: 990px;" data-baseurl="{{ route('ops.index') }}">
						<thead class="thead-dark">
							<tr>
								<th class="align-top">
									<div class="d-flex justify-content-between">
										<div>
											<span class="mr-3 pointer-cursor tbl-search">Record ID</span>
										</div>
										<span class="fa fa-times align-middle pointer-cursor tbl-close d-none" style="font-size: 1rem"></span>
									</div>
									<form class="d-none" method="get" action="{{ route('ops.search',['type'=>'record_id']) }}">
										<div class="input-group">
											<input type="text" class="form-control form-control-sm" name="searchtxt">
											<div class="input-group-append">
												<button class="btn btn-sm btn-secondary" type="submit">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</form>
								</th>
								<th class="align-top">
									<div class="d-flex justify-content-between">
										<div>
											<span class="mr-3 pointer-cursor tbl-search">Recording Date</span>
										</div>
										<span class="fa fa-times align-middle pointer-cursor tbl-close d-none" style="font-size: 1rem"></span>
									</div>
									<form class="d-none" method="get" action="{{ route('ops.search',['type'=>'recording_date']) }}">
										<div class="input-group">
											<input type="date" class="form-control form-control-sm" name="searchtxt">
											<div class="input-group-append">
												<button class="btn btn-sm btn-secondary" type="submit">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</form>
								</th>
								<th class="align-top">
									<div class="d-flex justify-content-between">
										<div>
											<span class="mr-3 pointer-cursor tbl-search">Agent ID</span>
										</div>
										<span class="fa fa-times align-middle pointer-cursor tbl-close d-none" style="font-size: 1rem"></span>
									</div>
									<form class="d-none" method="get" action="{{ route('ops.search',['type'=>'agent_id']) }}">
										<div class="input-group">
											<input type="number" class="form-control form-control-sm" name="searchtxt">
											<div class="input-group-append">
												<button class="btn btn-sm btn-secondary" type="submit">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</form>
								</th>
								<th class="align-top">
									<div class="d-flex justify-content-between">
										<div>
											<span class="mr-3 pointer-cursor tbl-search">Phone</span>
										</div>
										<span class="fa fa-times align-middle pointer-cursor tbl-close d-none" style="font-size: 1rem"></span>
									</div>
									<form class="d-none" method="get" action="{{ route('ops.search',['type'=>'phone']) }}">
										<div class="input-group">
											<input type="number" class="form-control form-control-sm" name="searchtxt">
											<div class="input-group-append">
												<button class="btn btn-sm btn-secondary" type="submit">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</form>
								</th>
								<th class="align-top">
									<div class="d-flex justify-content-between">
										<div>
											<span class="mr-3 pointer-cursor tbl-search">Auditor</span>
										</div>
										<span class="fa fa-times align-middle pointer-cursor tbl-close d-none" style="font-size: 1rem"></span>
									</div>
									<form class="d-none" method="get" action="{{ route('ops.search',['type'=>'auditor']) }}">
										<div class="input-group">
											<select class="form-control form-control-sm" name="searchtxt">
												@foreach($auditors as $auditor)
													<option value="{{ $auditor->id }}">{{ $auditor->name }}</option>
												@endforeach
											</select>
											<div class="input-group-append">
												<button class="btn btn-sm btn-secondary" type="submit">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</form>
								</th>
								<th class="align-top">Status</th>
							</tr>
						</thead>
						<tbody>
							@if(count($calllogs))
								@foreach($calllogs as $calllog)
									<tr>
										<td><a href="{{ route('ops.audited',['recording' => $calllog->recording_id]) }}">{{ $calllog->recording_id }}</a></td>
										<td>{{ date('m/d/Y',strtotime($calllog->timestamp)) }}</td>
										<td>{{ $calllog->user }}</td>
										<td>{{ $calllog->phone_number }}</td>
										<td>{{ $calllog->auditor->name }}</td>
										<td>{{ $calllog->status_name }}</td>
									</tr>
								@endforeach
							@else
								<tr class="text-center"><td colspan="6">Empty results</td></tr>
							@endif
						</tbody>
					</table>
					{{ $calllogs->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection