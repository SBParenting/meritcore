@extends('admin.layout.page')

	@section('title')
	    @if (!empty($user))
			{{ $user->getName("F L") }}
		@else
			Add New User
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
						<a href="{{ url('admin/users') }}">Users</a>
					</li>
					<li>
						<a href="{{ url('admin/users') }}">Manage Users</a>
					</li>

					<li class="active">

						@if (!empty($user))
							<strong>{{ $user->getName("F L") }}</strong>
						@else
							<strong>Add New User</strong>
						@endif
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/users') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Users</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		{!! Form::open(['class' => 'form-horizontal']) !!}

		<div class="wrapper wrapper-content animated">

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">User Account Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						{!! Form::hidden('id') !!}

						<div class="form-group">

							<label class="col-md-2 control-label">Display Name</label>
							<div class="col-md-4">{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}</div>
							<div class="col-md-4">{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Email Address</label>
							<div class="col-md-4">{!! Form::text('email', null, ['class' => 'form-control get-form-avatar', 'placeholder' => 'Email Address', 'data-avatar-url' => url("/admin/users/avatar")]) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Username</label>
							<div class="col-md-4">{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}</div>
						</div>


						<div class="hr-line-dashed"></div>

						<div class="form-group form-avatar" style="display:{{ isset($user->email) ? 'block' : 'none' }}">
							<label class="col-md-2 control-label">Gravatar</label>
							<div class="col-md-4">
								<img src="{{ isset($user->email) ? $user->avatar() : '' }}" class="img-thumbnail">
							</div>
							<div class="col-md-4"></div>
						</div>

						<div class="hr-line-dashed form-avatar" style="display:none"></div>


						<div class="form-group">
							<label class="col-md-2 control-label">Password</label>
							<div class="col-md-4">{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}</div>
							<div class="col-md-4">{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Role</label>
							<div class="col-md-4">

								<div class="btn-group js-dropdown-select width-100">
									{!! Form::dropdown('role_id', make_assoc_from_model($roles, 'id', 'display_name'), null, [], 'btn btn-default' ) !!}
								</div>

							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Status</label>
							<div class="col-md-4">

								<div class="btn-group js-dropdown-select width-100">
									{!! Form::dropdown('status', make_assoc(\App\Models\User::$statusses), 'Active', [], 'btn btn-success' ) !!}
								</div>

							</div>
						</div>

				</div>

			</div>


			<div class="row">
				<div class="col-md-12"><hr /></div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<span class="size-h4">User Profile Information</span>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12">

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Phone</label>
							<div class="col-md-3">{!! Form::text('daytime_phone', null, ['class' => 'form-control', 'placeholder' => 'Daytime Phone']) !!}</div>
							<div class="col-md-3">{!! Form::text('evening_phone', null, ['class' => 'form-control', 'placeholder' => 'Evening Phone']) !!}</div>
							<div class="col-md-3">{!! Form::text('mobile_phone', null, ['class' => 'form-control', 'placeholder' => 'Mobile Phone']) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Address</label>
							<div class="col-md-3">{!! Form::text('address_street', null, ['class' => 'form-control', 'placeholder' => 'Street']) !!}</div>
							<div class="col-md-3">{!! Form::text('address_city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}</div>
							<div class="col-md-3">{!! Form::text('address_postal_code', null, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-3">
								<div class="btn-group js-dropdown-select width-100">
									{!! Form::dropdown('address_province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-md-2 control-label">Notes</label>
							<div class="col-md-6">{!! Form::html('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'rows' => 3]) !!}</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class="col-md-10 col-sm-offset-2 text-right">
								<a href="{{ url('/admin/users') }}" class="btn btn-default close-button">Cancel</a>
								<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>
							</div>
						</div>
				</div>
			</div>

		</div>

		{!! Form::close() !!}

	@stop

@stop