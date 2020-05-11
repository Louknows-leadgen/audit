<div class="row">
	<div class="col-md-12">
		<div class="header">
			<div class="logo">
		        <img src="{{ asset('images/leadgen_logo.png') }}">
		        <span>LEADGEN QA AUDIT SYSTEM</span>
		    </div>
		    <div class="sign-in">
		    	@guest
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                @else
                	Logged in as
					<span class="dropdown-toggle" data-toggle="dropdown">
						{{ Auth::user()->role->name }}
					</span>
					<div class="dropdown-menu user-menu">
						<a class="dropdown-item menu-item" href="{{ route('root') }}">
							Home page
						</a>

						<a class="dropdown-item menu-item" href="{{ route('user.index') }}">
							My account
						</a>

						@can('register')
						<a class="dropdown-item menu-item" href="{{ route('register') }}">
							Create user
						</a>
						@endcan

						<a class="link dropdown-item menu-item" 
					   href="#" 
					   onclick="event.preventDefault();
			                        document.getElementById('logout-form').submit();">
			               Sign out
			            </a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			            	@csrf
			        	</form>

					</div>
					
				@endguest	
		    </div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="sub-header mb-4">
			@auth
				<ul class="d-flex align-items-center ml-5">
					@can('access',[4])
						<li class="list-inline-item mr-4"><a href="{{ route('auditor.index') }}">Available Logs</a></li>
						<li class="list-inline-item mr-4"><a href="{{ route('auditor.team_claimed') }}">Claimed Logs</a></li>
						<li class="list-inline-item mr-4"><a href="{{ route('auditor.index') }}">My Logs</a></li>
					@endcan
				</ul>
			@endauth
		</div>
	</div>
</div>