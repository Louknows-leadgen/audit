@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="box">
				<h5>Claimed Call Logs:</h5>
				<div class="table-responsive">
					<table class="table table-bordered table-sm w-100 d-block d-md-table" style="min-width: 990px;" data-baseurl="{{ route('ops.index') }}">
						<thead class="thead-dark">
							<tr>
								<th class="align-top">
									<div class="d-flex justify-content-between">
										<div>
											<span class="mr-3 pointer-cursor tbl-search">Record ID</span>
										</div>
										<span class="fa fa-times align-middle pointer-cursor tbl-close {{$searchtype == 'record_id' ? '' : 'd-none' }}" style="font-size: 1rem"></span>
									</div>
									<form class="{{$searchtype == 'record_id' ? '' : 'd-none'}}" method="get" action="{{ route('ops.search',['type'=>'record_id']) }}">
										<div class="input-group">
											<input type="text" class="form-control form-control-sm" name="searchtxt" value="{{ isset($searchtxt) && $searchtype == 'record_id' ? $searchtxt : '' }}">
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
										<span class="fa fa-times align-middle pointer-cursor tbl-close {{$searchtype == 'recording_date' ? '' : 'd-none' }}" style="font-size: 1rem"></span>
									</div>
									<form class="{{$searchtype == 'recording_date' ? '' : 'd-none'}}" method="get" action="{{ route('ops.search',['type'=>'recording_date']) }}">
										<div class="input-group">
											<input type="date" class="form-control form-control-sm" name="searchtxt" value="{{ isset($searchtxt) && $searchtype == 'recording_date' ? $searchtxt : '' }}">
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
										<span class="fa fa-times align-middle pointer-cursor tbl-close {{$searchtype == 'agent_id' ? '' : 'd-none' }}" style="font-size: 1rem"></span>
									</div>
									<form class="{{$searchtype == 'agent_id' ? '' : 'd-none'}}" method="get" action="{{ route('ops.search',['type'=>'agent_id']) }}">
										<div class="input-group">
											<input type="number" class="form-control form-control-sm" name="searchtxt" value="{{ isset($searchtxt) && $searchtype == 'agent_id' ? $searchtxt : '' }}">
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
										<span class="fa fa-times align-middle pointer-cursor tbl-close {{$searchtype == 'phone' ? '' : 'd-none' }}" style="font-size: 1rem"></span>
									</div>
									<form class="{{$searchtype == 'phone' ? '' : 'd-none'}}" method="get" action="{{ route('ops.search',['type'=>'phone']) }}">
										<div class="input-group">
											<input type="number" class="form-control form-control-sm" name="searchtxt" value="{{ isset($searchtxt) && $searchtype == 'phone' ? $searchtxt : '' }}">
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
										<span class="fa fa-times align-middle pointer-cursor tbl-close {{$searchtype == 'auditor' ? '' : 'd-none' }}" style="font-size: 1rem"></span>
									</div>
									<form class="{{$searchtype == 'auditor' ? '' : 'd-none'}}" method="get" action="{{ route('ops.search',['type'=>'auditor']) }}">
										<div class="input-group">
											<select class="form-control form-control-sm" name="searchtxt">
												@foreach($auditors as $auditor)
													<option value="{{ $auditor->id }}" {{ isset($searchtxt) && $searchtype == 'auditor' && $searchtxt == $auditor->id ? 'selected' : '' }}>{{ $auditor->name }}</option>
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
							@if(count($calls))
								@foreach($calls as $calllog)
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
					{{ $calls->appends(['searchtxt' => $searchtxt])->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection