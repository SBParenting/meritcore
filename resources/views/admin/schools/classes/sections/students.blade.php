
<br />

<a href="{{ url('/admin/s/schools/add-student/'.$record->school_id.'/'.$record->id) }}" class="btn btn-default close-button pull-right"><i class="fa fa-plus"></i> Add Student</a>

<div class="clearfix"></div>

<hr />

<table class="table table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" class="i-checks js-select-all">
			</th>
			<th class="sortable" data-field="title">Student ID</th>
			<th class="sortable" data-field="name">Name</th>
			<th class="sortable" data-field="grade">Grade</th>
			<th class="sortable text-center" data-field="created_at">Created</th>
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
				<td>{{ $record->sid }}</td>
				<td>{{ $record->getName("F L") }}</td>
				<td>{{ $record->grade }}</td>
				<td class="text-center">{{ get_date($record->created_at, "M j, Y") }}</a></td>
				<td>
					<a href="{{ url("/admin/s/schools/update-student/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View class information."><i class="fa fa-info"></i> &nbsp;View</a>
				</td>
			</tr>

		@endforeach

	</tbody>
</table>

{!! $records->render() !!}