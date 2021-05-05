<h5 class="text-secondary">{{ $date }}</h5>
<div class="row">
	<div class="col-md-8">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Hour</th>
						<th>Count</th>
					</tr>
				</thead>
				<tbody>
				@foreach($hours as $hour)
					<tr>
						<td>{{ $hour->hr }}</td>
						<td>{{ $hour->ctr }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>