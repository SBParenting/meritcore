
<ul class="list-unstyled list-info top-padding">
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Name</label>
		{{ $record->name }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>School District</label>
		@if ($record->board)
			<a href="{{ url("/admin/s/boards/info/$record->school_board_id") }}">{{ $record->board->name }}</a>
		@endif
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Email</label>
		{{ $record->email }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Address</label>
		{{ $record->getAddress() }}
	</li>
	<!--<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Classes</label>
		<a href="{{ url("/admin/s/schools/info-classes/$record->id") }}" class="label label-{{ $record->classes_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->classes_count }}</a>
	</li>-->

	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Students</label>
		<a href="{{ url("/admin/s/schools/info-students/$record->id") }}" class="label label-{{ $record->students_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->students_count }}</a>
	</li>

	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Total Surveys</label>
		<a href="{{ url("/admin/s/schools/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_total_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->surveys_total_count }}</a>
	</li>

	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Active Surveys</label>
		<a href="{{ url("/admin/s/schools/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_active_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->surveys_active_count }}</a>
	</li>

</ul>

<div class="hr-line-dashed"></div>

<a href="{{ url("/admin/s/schools/remove/$record->id") }}" class="btn btn-danger pull-right inline js-post-remove"><i class="fa fa-trash"></i> Remove School</a>

<a href="{{ url("/admin/s/schools/update/$record->id") }}" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Update School Information</a>