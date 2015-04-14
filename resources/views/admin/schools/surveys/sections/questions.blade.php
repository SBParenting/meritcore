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
					<li>
						<a href="{{ url('admin/s/surveys/') }}">Manage Survey</a>
					</li>
					<li>
						<a href="{{ url("admin/s/surveys/info/$record->survey_id") }}">{{ $record->title }}</a>
					</li>
					<li class="active">
						<strong>Manage Questions</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Question Management</span>
			</div>
			<div class="col-md-6 text-right">
                <a href="{{ url("/admin/s/surveys/add-question/$record->survey_id") }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add Question</a>
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
							<th class="sortable" data-field="num">Number</th>
							<th class="sortable" data-field="num">Question</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>

						{!! Form::token() !!}

						@foreach($record as $record)

							<tr id="record-{{ $record->id }}">
								<td>
									<input type="checkbox" class="i-checks js-select" data-record-id="{{ $record->id }}">
								</td>
								<td>{{ $record->num }}</td>
								<td><a href="{{ url("/admin/s/surveys/info-question/$record->id") }}">{{ $record->question }}</a></td>
								<td>
									<a href="{{ url("/admin/s/surveys/info-question/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View Question Information."><i class="fa fa-info"></i> &nbsp;View</a>
									<a href="{{ url("/admin/s/surveys/remove-question/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post-remove" title="Remove Question." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>

						@endforeach

					</tbody>
				</table>


			</div>

		</div>

	@stop

@stop