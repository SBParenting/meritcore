<br /><br />
{!! Form::open(['class' => 'form-horizontal']) !!}
	<div class="form-group">
		<label class="col-md-2 control-label">Instructor</label>
		<div class="col-md-4">
			<div class="js-dropdown-select padded">
				{!! Form::select('user_id',array_merge([''=>'Instructor'], \App\Models\User::getUsers()), null, ['class' => 'form-control', 'placeholder' => 'Instructor','id' => 'teacher-field'], 'btn btn-default') !!}
			</div>
		</div>
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
		<div class="col-md-10 col-sm-offset-2 text-right">
			<a href="{{ url("/admin/s/schools/info-users/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
			<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
		</div>
	</div>

{!! Form::close() !!}