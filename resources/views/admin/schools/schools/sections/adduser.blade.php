<br /><br />
{!! Form::open(['class' => 'form-horizontal']) !!}

	<div class="form-group">

		<label class="col-md-2 control-label">Display Name</label>
		<div class="col-md-4">{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}</div>
		<div class="col-md-4">{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Email Address</label>
		<div class="col-md-4">{!! Form::text('email', null, ['class' => 'form-control get-form-avatar', 'placeholder' => 'Email Address', 'data-avatar-url' => url("/admin/users/avatar")]) !!}</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Username</label>
		<div class="col-md-4">{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}</div>
	</div>


	<div class="hr-line-dashed"></div>

	<div class="form-group form-avatar" style="display:{{ isset($user->email) ? 'block' : 'none' }}">
		<label class="col-md-2 control-label">Gravatar</label>
		<div class="col-md-4">
			<img src="{{ isset($user->email) ? $user->avatar() : '' }}" class="img-thumbnail">
		</div>
		<div class="col-md-4"></div>
	</div>

	<div class="hr-line-dashed form-avatar" style="display:none"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Role</label>
		<div class="col-md-4">
			<div class="js-dropdown-select padded">
				{!! Form::dropdown('role_id', $roles, null, ['class' => 'form-control', 'placeholder' => 'Role'], 'btn btn-default') !!}
			</div>
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Password</label>
		<div class="col-md-4">{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}</div>
		<div class="col-md-4">{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<div class="col-md-10 col-sm-offset-2 text-right">
			<a href="{{ url("/admin/s/schools/info-users/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
			<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
		</div>
	</div>

{!! Form::close() !!}