
<br />

<a href="{{ url('/admin/s/boards/add-user/'.$record->id) }}" class="btn btn-default close-button pull-right"><i class="fa fa-plus"></i> Add Administrator</a>

<div class="clearfix"></div>

<hr />

<table class="table table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" class="i-checks js-select-all">
			</th>
			<th class="sortable" data-field="name">Name</th>
			<th class="sortable" data-field="role">Role</th>
			<th class="sortable" data-field="email">email</th>
			<th class="sortable text-center" data-field="last_login">Last Login</th>
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
				<td>{{ $record->getName("F L") }}</td>
				<td>{{ $record->role_name }}</td>
				<td>{{ $record->email }}</td>
				<td class="text-center">{{ get_date($record->last_login, "M j, Y H:i") }}</a></td>
				<td>
					<a href="{{ url("/admin/users/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View class information."><i class="fa fa-info"></i> &nbsp;View</a>
				</td>
			</tr>

		@endforeach

	</tbody>
</table>

@if (count($records) > 0)
	{!! $records->render() !!}
@endif