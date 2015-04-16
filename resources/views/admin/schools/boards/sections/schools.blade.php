
<br />

<a href="{{ url('/admin/s/boards/add-school/'.$record->id) }}" class="btn btn-default close-button pull-right"><i class="fa fa-plus"></i> Add School</a>

<div class="clearfix"></div>

<hr />

<table class="table table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" class="i-checks js-select-all">
			</th>
			<th class="sortable" data-field="name">Name</th>
			<th class="sortable" data-field="schoolboard">School District</th>
			<th class="sortable text-center" data-field="classes_count">Classes</th>
			<th class="sortable text-center" data-field="students_count">Students</th>
			<th class="sortable text-center" data-field="surveys_total_count">Total Surveys</th>
			<th class="sortable text-center" data-field="surveys_active_count">Active Surveys</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>

		{!! Form::token() !!}

		@foreach($records as $school)

			<tr id="record-{{ $school->id }}">
				<td>
					<input type="checkbox" class="i-checks js-select" data-record-id="{{ $school->id }}">
				</td>
				<td><a href="{{ url("/admin/s/schools/info/$school->id") }}">{{ $school->name }}</a></td>
				<td>{{ str($school->school_board) }}</td>
				<td class="text-center"><a href="{{ url("/admin/s/schools/info-classes/$school->id") }}" class="label label-{{ $school->classes_count > 0 ? 'info' : 'default' }}">{{ $school->classes_count }}</a></td>
				<td class="text-center"><a href="{{ url("/admin/s/schools/info-students/$school->id") }}" class="label label-{{ $school->students_count > 0 ? 'info' : 'default' }}">{{ $school->students_count }}</a></td>
				<td class="text-center"><a href="{{ url("/admin/s/schools/info-surveys/$school->id") }}" class="label label-{{ $school->surveys_total_count > 0 ? 'info' : 'default' }}">{{ $school->surveys_total_count }}</a></td>
				<td class="text-center"><a href="{{ url("/admin/s/schools/info-surveys/$school->id") }}" class="label label-{{ $school->surveys_active_count > 0 ? 'info' : 'default' }}">{{ $school->surveys_active_count }}</a></td>
				<td>
					<a href="{{ url("/admin/s/schools/info/$school->id") }}" class="btn btn-xs btn-default do-tooltip" title="View school information."><i class="fa fa-info"></i> &nbsp;View</a>
				</td>
			</tr>

		@endforeach

	</tbody>
</table>


{!! $records->render() !!}