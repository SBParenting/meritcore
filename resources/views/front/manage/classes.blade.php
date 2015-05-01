@extends('common.layout.front')

	@section('title')
		Schools
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				@include('front.manage.partials.nav')

				@if (!empty($school))

					<div class="col-md-12">

						@if(can('manage:schools'))

							<a href="{{ url('m/schools') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back to Schools List</a>

						@endif

						@if ($is_admin)

	                    	<h1><a href="{{ url('m/schools/'.$school->id) }}">{{ $school->name }}</a></h1>

	                    @else

	                    	<h1><a href="{{ url('m/classes/') }}">{{ $school->name }}</a></h1>

	                    @endif

						<hr />

						<div class="btn-group">
							<a href="?status=Active" class="btn btn-default {{ $status=='Active' ? 'active' : '' }}">Active Classes</a>
							<a href="?status=Archived" class="btn btn-default {{ $status=='Archived' ? 'active' : '' }}">Archived Classes</a>
						</div>

						<hr />

					</div>

					<!-- @include('front.manage.sections.classroom_filters') -->

					<?php $count = 0; ?>

					@foreach ($classes as $class)

						@include('front.manage.items.classroom')

					@endforeach

					@if (count($classes) > 0)

						@include('front.manage.items.classroom_add')

					@else

						@include('front.manage.items.classroom_none')

					@endif

					<div class="col-md-12">
						<hr />
					</div>

					<div class="col-md-4">

						<div id="classesInfoPanel" class="panel-group class-panel closable-panel closed">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-th-large"></i>Classes
								</div>
								<div class="panel-body">

									<div class="giant-count">
										<span class="num">{{ count($classes) }}</span> {{ str_plural('Classroom', count($classes)) }}
									</div>

									<a href="#" id="btnManageStudents" class="btn btn-block btn-line-info hide-panel active"><i class="fa fa-arrow-left"></i> Go Back</a>
									<br />
								</div>

							</div>

						</div>

					</div>

					<div class="col-md-8">

						<div id="addClass" class="closed closable-panel">
							<div class="panel-group class-panel">
								<div class="panel panel-default">
									<div class="panel-heading">
										Class Information
									</div>
									<div class="panel-body">
										{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/classes/add" ]) !!}

											{!! Form::hidden('school_id', $school->id) !!}

											<br />

											<h4>Class Information</h4>

											<hr />

											<div class="form-group">
												<label class="col-sm-2">Title</label>
												<div class="col-sm-8">
													{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2">Grade</label>
												<div class="col-sm-8">
													<div class="js-dropdown-select padded">
														{!! Form::dropdown('grade', $grades, null, ['class' => 'form-control', 'placeholder' => 'Grade'], 'btn btn-default') !!}
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2">Instructor</label>
												<div class="col-sm-8">
													<div class="js-dropdown-select padded">
														{!! Form::dropdown('teacher_id', make_assoc_from_model($teachers, 'id', 'name'), null, ['class' => 'form-control', 'placeholder' => 'Select Instructor from the list'], 'btn btn-default') !!}
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2"></label>
												<div class="col-sm-8 text-center">
													OR CREATE NEW INSTRUCTOR
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2">First Name</label>
												<div class="col-sm-8">
													{!! Form::text('teacher_first_name', null, ['class' => 'form-control', 'placeholder' => 'Instructor First Name']) !!}
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2">Last Name</label>
												<div class="col-sm-8">
													{!! Form::text('teacher_last_name', null, ['class' => 'form-control', 'placeholder' => 'Instructor Last Name']) !!}
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2">Email</label>
												<div class="col-sm-8">
													{!! Form::text('teacher_email', null, ['class' => 'form-control', 'placeholder' => 'Instructor Email']) !!}
												</div>
											</div>

											<hr />

											<a href="#" class="btn btn-default btn-lg hide-panel dont-activate">Cancel</a>

											<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> Save Changes</button>

										{!! Form::close() !!}
									</div>

								</div>

							</div>
						</div>


					</div>

				@endif

			</div>

		</div>

	@stop

@stop