
<br />

<a href="{{ url('/admin/s/schools/add-class/'.$record->id) }}" class="btn btn-default close-button pull-right"><i class="fa fa-plus"></i> Add Class</a>

<div class="clearfix"></div>

<hr />

<table class="table table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" class="i-checks js-select-all">
			</th>
			<th class="sortable" data-field="title">Class Title</th>
			<th class="sortable" data-field="teacher">Instructor</th>
			<th class="sortable" data-field="grade">Grade</th>
			<th class="sortable text-center" data-field="students_count">Students</th>
			<th class="sortable text-center" data-field="surveys_total_count">Total Surveys</th>
			<th class="sortable text-center" data-field="surveys_active_count">Active Surveys</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>

		{!! Form::token() !!}

		@foreach($records as $record)

			<tr id="record-{{ $record->id }}">
				<td>
					<input type="checkbox" class="i-checks js-select" data-record-id="{{ $record->id }}">
				</td>
				<td><a href="{{ url("/admin/s/classes/info/$record->id") }}">{{ $record->title }}</a></td>
				<td>{{ $record->teacher_name }}</td>
				<td>{{ $record->grade }}</td>
				<td class="text-center"><a href="{{ url("/admin/s/classes/info-students/$record->id") }}" class="label label-{{ $record->students_count > 0 ? 'info' : 'default' }}">{{ $record->students_count }}</a></td>
				<td class="text-center"><a href="{{ url("/admin/s/classes/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_total_count > 0 ? 'info' : 'default' }}">{{ $record->surveys_total_count }}</a></td>
				<td class="text-center"><a href="{{ url("/admin/s/classes/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_active_count > 0 ? 'info' : 'default' }}">{{ $record->surveys_active_count }}</a></td>
				<td>
					<a href="{{ url("/admin/s/classes/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View class information."><i class="fa fa-info"></i> &nbsp;View</a>
				</td>
			</tr>

		@endforeach

	</tbody>
</table>

{!! $records->render() !!}