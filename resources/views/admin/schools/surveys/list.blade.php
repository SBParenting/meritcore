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
						<strong>Manage Surveys</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2">Survey Management</span>
			</div>
			<div class="col-md-6 text-right">
                <a href="{{ url('/admin/s/surveys/add') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add Survey</a>
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
							<th class="sortable" data-field="title">Title</th>
							<th class="sortable" data-field="count_questions">Total Question</th>
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
								<td><a href="{{ url("/admin/s/surveys/info/$record->id") }}">{{ $record->title }}</a></td>
								<td>{{ str($record->count_questions) }}</td>
								<td>
									<a href="{{ url("/admin/s/surveys/info/$record->id") }}" class="btn btn-xs btn-default do-tooltip" title="View Survey information."><i class="fa fa-info"></i> &nbsp;View</a>
									<a href="{{ url("/admin/s/surveys/remove/$record->id") }}" class="btn btn-xs btn-default do-tooltip js-post-remove" title="Remove Survey." data-remove="#record-{{ $record->id }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>

						@endforeach

					</tbody>
				</table>

				@if (count($records) > 0)
					{!! $records->render() !!}
				@endif

			</div>

		</div>

	@stop

@stop