@extends('admin.layout.page')

	@section('title')
	    Manage Users
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage School District</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">School District Management</span>
			</div>
			<div class="col-md-6 text-right">
                <a href="{{ url('/admin/s/boards/add') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add School District</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="row">

			<div class="col-lg-12">

				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								<input type="checkbox" class="i-checks js-select-all">
							</th>
							<th class="sortable" data-field="name">Name</th>
							<th class="sortable" data-field="email">Email</th>
							<th class="sortable" data-field="province">Province</th>
							<th class="sortable" data-field="country">Country</th>
							<th class="sortable" data-field="created_at">Created</th>
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
								<td><a href="{{ url("/admin/s/boards/info/$record->id") }}">{{ $record->name }}</a></td>
								<td>{{ $record->email }}</td>
								<td>{{ str($record->province) }}</td>
								<td>{{ str($record->country) }}</td>
								<td>{{ str(get_date($record->created_at)) }}</td>
								<td>
									<a href="{{ url("/admin/s/boards/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View school District information."><i class="fa fa-info"></i> &nbsp;View</a>
								</td>
							</tr>

						@endforeach

					</tbody>
				</table>

				{!! $records->render() !!}

			</div>

		</div>

	@stop

@stop