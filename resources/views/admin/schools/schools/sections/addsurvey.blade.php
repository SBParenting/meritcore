<br /><br />
{!! Form::open(['class' => 'form-horizontal']) !!}

	<div class="form-group">
		<label class="col-md-2 control-label">Survey Title</label>
		<div class="col-md-4">
			{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Survey Title']) !!}
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">Classes</label>
		<div class="col-md-4">
			<div class="js-dropdown-select padded">
				{!! Form::dropdown('class_id', $classes, $record->class_id, ['class' => 'form-control', 'placeholder' => 'Class', 'readonly' => ($record->class_id)?'readonly ':'false'], 'btn btn-default') !!}
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">Questionnaire</label>
		<div class="col-md-4">
			<div class="js-dropdown-select padded">
				{!! Form::dropdown('survey_id', $survey_id, $record->survey_id, ['class' => 'form-control', 'placeholder' => 'Select Survey', 'readonly' => ($record->survey_id)?'readonly ':'false'], 'btn btn-default') !!}
			</div>
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<div class="col-md-10 col-sm-offset-2 text-right">
			<a href="{{ url("/admin/s/schools/info-surveys/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
			<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
		</div>
	</div>

{!! Form::close() !!}
