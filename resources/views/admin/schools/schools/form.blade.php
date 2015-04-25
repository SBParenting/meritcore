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
						<a href="{{ url('admin/s/schools') }}">Manage Schools</a>
					</li>

					<li class="active">

						@if (!empty($record))
							<strong>{{ $record->name }}</strong>
						@else
							<strong>Add School</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/schools') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Schools</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		{!! Form::open(['class' => 'form-horizontal']) !!}

		<div class="wrapper wrapper-content animated">

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">Schools Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						{!! Form::hidden('id') !!}

					@if(isset($school_board_id))
						{!! Form::hidden('school_board_id',$school_board_id) !!}
					@else
						<div class="form-group">
							<label class="col-md-2 control-label">School Board</label>
							<div class="col-md-4">
								<div class="js-dropdown-select padded">
									{!! Form::dropdown('school_board_id', $school_boards, null, ['class' => 'form-control', 'placeholder' => 'School Board'], 'btn btn-default') !!}
								</div>
							</div>
						</div>
					@endif

						<div class="form-group">
							<label class="col-md-2 control-label">School Name</label>
							<div class="col-md-4">
								{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'School Name']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Email</label>
							<div class="col-md-4">
								{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Street</label>
							<div class="col-md-4">
								{!! Form::text('address_street', null, ['class' => 'form-control', 'placeholder' => 'Address Street']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">City</label>
							<div class="col-md-4">
								{!! Form::text('address_city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Province</label>
							<div class="col-md-4">
								<div class="js-dropdown-select padded">
									{!! Form::dropdown('address_province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Country</label>
							<div class="col-md-4">
								{!! Form::text('address_country', null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Postal Code</label>
							<div class="col-md-4">
								{!! Form::text('address_postal_code', null, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								@if (!empty($record))
									<a href="{{ url("/admin/s/schools/info/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
								@else
									<a href="{{ url('/admin/s/schools') }}" class="btn btn-default btn-lg close-button">Cancel</a>
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