<br /><br />
{!! Form::open(['class' => 'form-horizontal']) !!}

	<div class="form-group">
		<label class="col-md-2 control-label">Student ID</label>
		<div class="col-md-4">
			{!! Form::text('sid', null, ['class' => 'form-control', 'placeholder' => 'Student ID']) !!}
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">First Name</label>
		<div class="col-md-4">
			{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label">Last Name</label>
		<div class="col-md-4">
			{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">Date of Birth</label>
		<div class="col-md-4">
			<div class="input-group date">
				{!! Form::text('date_birth', null, ['class' => 'form-control', 'placeholder' => 'Date of Birth']) !!}
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">Grade</label>
		<div class="col-md-4">
			<div class="js-dropdown-select padded">
				{!! Form::dropdown('grade', $grades, null, ['class' => 'form-control', 'placeholder' => 'Grade'], 'btn btn-default') !!}
			</div>
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<div class="col-md-10 col-sm-offset-2 text-right">
			<a href="{{ url("/admin/s/schools/info-students/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
			<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
		</div>
	</div>

{!! Form::close() !!}
