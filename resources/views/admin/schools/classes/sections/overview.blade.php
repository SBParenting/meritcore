
<ul class="list-unstyled list-info top-padding">
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Title</label>
		{{ $record->title }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>School</label>
		@if ($record->school)
			<a href="{{ url("/admin/s/schools/info/$record->school_id") }}">{{ $record->school->name }}</a>
		@endif
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Teacher</label>
		@if ($record->teacher)
			<a href="{{ url("/admin/users/info/$record->teacher_id") }}">{{ $record->teacher->getName('F L') }}</a>
		@endif
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Grade</label>
		{{ $record->grade }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Students</label>
		<a href="{{ url("/admin/s/classes/info-students/$record->id") }}" class="label label-{{ $record->students_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->students_count }}</a>
	</li>

	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Total Surveys</label>
		<a href="{{ url("/admin/s/classes/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_total_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->surveys_total_count }}</a>
	</li>

	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Active Surveys</label>
		<a href="{{ url("/admin/s/classes/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_active_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->surveys_active_count }}</a>
	</li>

</ul>

<div class="hr-line-dashed"></div>

<a href="{{ url("/admin/s/classes/remove/$record->id") }}" class="btn btn-danger pull-right inline js-post-remove"><i class="fa fa-trash"></i> Remove Class</a>

<a href="{{ url("/admin/s/classes/update/$record->id") }}" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Update Class Information</a>