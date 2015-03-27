
<br />

<a href="{{ url('/admin/s/schools/add-survey/'.$record->id) }}" class="btn btn-default close-button pull-right"><i class="fa fa-plus"></i> Add Survey</a>

<div class="clearfix"></div>

<hr />

<table class="table table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" class="i-checks js-select-all">
			</th>
			<th class="sortable" data-field="title">Title</th>
			<th class="sortable text-center" data-field="status">Status</th>
			<th class="sortable text-center" data-field="start_date">Start Date</th>
			<th class="sortable text-center" data-field="end_date">End Date</th>
			<th class="sortable text-center" data-field="count_started">Started</th>
			<th class="sortable text-center" data-field="count_completed">Completed</th>
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
				<td>{{ $record->title }}</td>
				<td class="text-center">
					@if ($record->status == 'Active')
						<span class="label label-info">{{ $record->status }}</span>
					@else
						<span class="label label-default">{{ $record->status }}</span>
					@endif
				</td>
				<td class="text-center">{{ get_date($record->start_date, "M j, Y") }}</td>
				<td class="text-center">{{ get_date($record->end_date, "M j, Y") }}</td>
				<td class="text-center"><span class="label label-default">{{ $record->count_started }} / {{ $record->count_total }}</span></td>
				<td class="text-center"><span class="label label-default">{{ $record->count_completed }} / {{ $record->count_total }}</span></td>
				<td>
					<a href="{{ url("/admin/s/schools/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View class information."><i class="fa fa-info"></i> &nbsp;View</a>
				</td>
			</tr>

		@endforeach

	</tbody>
</table>

{!! $records->render() !!}