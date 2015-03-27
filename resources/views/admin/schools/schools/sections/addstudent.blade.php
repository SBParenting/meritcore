<br /><br />
{!! Form::open(['class' => 'form-horizontal']) !!}

	<div class="form-group">
		<label class="col-md-2 control-label">Student Name</label>
		<div class="col-md-4">
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Class Title']) !!}
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
