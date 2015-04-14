@extends('admin.layout.page')

	@section('title')
	   @if (!empty($record))
			{{ $record->title }}
		@else
			Add Survey
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
						<a href="{{ url('admin/s/surveys') }}">Manage Surveys</a>
					</li>

					<li class="active">

						@if (!empty($record))
							<strong>{{ $record->title }}</strong>
						@else
							<strong>Add Survey</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/surveys') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Surveys</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		{!! Form::open(['class' => 'form-horizontal']) !!}

		<div class="wrapper wrapper-content animated">

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">Survey Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						{!! Form::hidden('id') !!}

						<div class="form-group">
							<label class="col-md-2 control-label">Survey Title</label>
							<div class="col-md-4">
								{!! Form::text('title',(isset($record))?$record->title:null, ['class' => 'form-control', 'placeholder' => 'Survey Title']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								@if(isset($record))
									<a href="{{ url("/admin/s/surveys/questions/$record->id") }}" class="btn btn-default btn-lg help-button">View Questions</a>
								@endif
								@if (!empty($record))
									<a href="{{ url("/admin/s/surveys/info/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
								@else
									<a href="{{ url('/admin/s/surveys') }}" class="btn btn-default btn-lg close-button">Cancel</a>
								@endif
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