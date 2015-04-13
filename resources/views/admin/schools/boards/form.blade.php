@extends('admin.layout.page')

	@section('title')
	   @if (!empty($record))
			{{ $record->name }}
		@else
			Add School Board
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
						<a href="{{ url('admin/s/boards') }}">Manage School District</a>
					</li>

					<li class="active">

						@if (!empty($record))
							<strong>{{ $record->name }}</strong>
						@else
							<strong>Add School Board</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/boards') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to School District</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		{!! Form::open(['class' => 'form-horizontal']) !!}

		<div class="wrapper wrapper-content animated">

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">School Board Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						{!! Form::hidden('id') !!}

						<div class="form-group">

							<label class="col-md-2 control-label">Name</label>
							<div class="col-md-4">{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Email Address</label>
							<div class="col-md-4">{!! Form::text('email', null, ['class' => 'form-control get-form-avatar', 'placeholder' => 'Email Address', 'data-avatar-url' => url("/admin/users/avatar")]) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Province</label>
							<div class="col-md-4">
								<div class="js-dropdown-select padded">
									{!! Form::dropdown('province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Country</label>
							<div class="col-md-4">
								<div class="js-dropdown-select padded">
									{!! Form::dropdown('country', ['Canada' => 'Canada', 'US' => 'United States'], null, ['class' => 'form-control', 'placeholder' => 'Country'], 'btn btn-default') !!}
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								<a href="{{ url('/admin/s/boards') }}" class="btn btn-default btn-lg close-button">Cancel</a>
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