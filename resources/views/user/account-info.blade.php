<div class="card acnt-tabcontent account-info">
	<div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <div><h5>Account Info</h5></div>
            </div>  
        </div>
    </div>
    <div class="card-body">
    	<div class="row">
    		<div class="col-md-12">
                <form class="account-form" 
                      action="{{route('user.update_account')}}" 
                      method="put">

        			<table class="display-info">
        				<tr>
        					<td><strong>Name</strong></td>
        					<td>
                                <input type="text" class="input-underline" name="name" value="{{$user->name}}">
                                <span class="name invalid-feedback" role="alert"></span>
                            </td>
        				</tr>
        				<tr>
        					<td><strong>Role (Fix)</strong></td>
        					<td>{{$user->role->name}}</td>
        				</tr>
        				<tr>
        					<td><strong>Email</strong></td>
        					<td>
        						<input type="text" class="input-underline" name="email" value="{{ $user->email }}">
                                <span class="email invalid-feedback" role="alert"></span>
                                <div class="hide account-notif"></div>
        					</td>
        				</tr>
        			</table>
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-primary text-right">Update</button>
                    </div>

                </form>
    		</div>
    	</div>
    </div>
</div>