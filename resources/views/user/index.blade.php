@extends('layouts.app')

@section('title','Account')


@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 mr-5">
				<ul class="list-group account">
					<li class="list-group-item mb-2 actv-acnt-opt acnt-tab"
						data-tab="account-info">
						<span class="fa fa-vcard-o mr-2 icon"></span>
						<span class="title">Account info</span>
					</li>
					<li class="list-group-item mb-2 acnt-tab"
						data-tab="change-password">
						<span class="fa fa-key mr-2 icon"></span>
						<span class="title">Change password</span>
					</li>
					<li class="list-group-item mb-2 acnt-tab link">
						<span class="fa fa-mail-reply-all mr-2 icon"></span>
						<span class="title" data-url="{{ URL::previous() }}">Go back</span>
					</li>
				</ul>
			</div>
			<div class="col-md-8">

				@include('user.account-info')
				@include('user.change-password')

			</div>
		</div>
	</div>


@endsection