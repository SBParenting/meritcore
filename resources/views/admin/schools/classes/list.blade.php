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
						<strong>Manage Classes</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Classes Management</span>
			</div>
			<div class="col-md-6 text-right">
                <!--<a href="{{ url('/admin/s/classes/add') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add Class</a>-->
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
							<th class="sortable" data-field="school">School</th>
							<th class="sortable" data-field="title">Class Title</th>
							<th class="sortable" data-field="teacher">Teacher</th>
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
								<td>{{ $record->school_name }}</td>
								<td><a href="{{ url("/admin/s/classes/info/$record->id") }}">{{ $record->title }}</a></td>
								<td>{{ $record->teacher_name }}</td>
								<td>{{ $record->grade }}</td>
								<td class="text-center"><a href="#" class="label label-{{ $record->students_count > 0 ? 'info' : 'default' }}">{{ $record->students_count }}</a></td>
								<td class="text-center"><a href="#" class="label label-{{ $record->surveys_total_count > 0 ? 'info' : 'default' }}">{{ $record->surveys_total_count }}</a></td>
								<td class="text-center"><a href="#" class="label label-{{ $record->surveys_active_count > 0 ? 'info' : 'default' }}">{{ $record->surveys_active_count }}</a></td>
								<td>
									<a href="{{ url("/admin/s/classes/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View school board information."><i class="fa fa-info"></i> &nbsp;View</a>
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