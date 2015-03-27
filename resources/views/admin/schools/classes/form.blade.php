@extends('admin.layout.page')

	@section('title')
	   @if (!empty($record))
			{{ $record->title }}
		@else
			Add Class
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
						<a href="{{ url('admin/s/classes') }}">Manage Classes</a>
					</li>

					<li class="active">

						@if (!empty($record))
							<strong>{{ $record->title }}</strong>
						@else
							<strong>Add Class</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/classes') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Classes</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		{!! Form::open(['class' => 'form-horizontal']) !!}

		<div class="wrapper wrapper-content animated">

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">Class Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						{!! Form::hidden('id') !!}

						<div class="form-group">

							<label class="col-md-2 control-label">Title</label>
							<div class="col-md-4">{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Grade</label>
							<div class="col-md-4">
								<div class="js-dropdown-select padded">
									{!! Form::dropdown('grade', $grades, null, ['class' => 'form-control', 'placeholder' => 'Grade'], 'btn btn-default') !!}
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Teacher</label>
							<div class="col-md-4">
								<div class="js-dropdown-select padded">
									{!! Form::dropdown('teacher_id', make_assoc_from_model($teachers, 'id', 'name'), null, ['class' => 'form-control', 'placeholder' => 'Teacher'], 'btn btn-default') !!}
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								<a href="{{ url('/admin/s/classes') }}" class="btn btn-default btn-lg close-button">Cancel</a>
								<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
							</div>
						</div>

				</div>

			</div>


			<div class="row">
				<div class="col-md-12"><hr /></div>
			</div>


		</div>

		{!! Form::close() !!}

	@stop

@stop