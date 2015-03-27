@extends('admin.layout.page')

	@section('title')
	   @if (!empty($record))
			{{ $record->title }}
		@else
			Add School
		@endif
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Schools</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Schools Management</span>
			</div>
			<div class="col-md-6 text-right">
                <a href="{{ url('/admin/s/schools/add') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add Schools</a>
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
							<th class="sortable" data-field="schoolboard">School Board</th>
							<th class="sortable text-center" data-field="classes_count">Classes</th>
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
								<td><a href="{{ url("/admin/s/schools/info/$record->id") }}">{{ $record->name }}</a></td>
								<td>{{ str($record->school_board) }}</td>
								<td class="text-center"><a href="{{ url("/admin/s/schools/info-classes/$record->id") }}" class="label label-{{ $record->classes_count > 0 ? 'info' : 'default' }}">{{ $record->classes_count }}</a></td>
								<td class="text-center"><a href="{{ url("/admin/s/schools/info-students/$record->id") }}" class="label label-{{ $record->students_count > 0 ? 'info' : 'default' }}">{{ $record->students_count }}</a></td>
								<td class="text-center"><a href="{{ url("/admin/s/schools/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_total_count > 0 ? 'info' : 'default' }}">{{ $record->surveys_total_count }}</a></td>
								<td class="text-center"><a href="{{ url("/admin/s/schools/info-surveys/$record->id") }}" class="label label-{{ $record->surveys_active_count > 0 ? 'info' : 'default' }}">{{ $record->surveys_active_count }}</a></td>
								<td>
									<a href="{{ url("/admin/s/schools/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View school information."><i class="fa fa-info"></i> &nbsp;View</a>
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