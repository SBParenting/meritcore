@extends('common.layout.front')

	@section('title')
		Register
	@stop

	@section('content')

		<div class="page-wizard">

			<div class="signin-header">
				<div class="container text-center">
					<a href="{!! url('/login') !!}"><img src="{!! url('public/front/img/mc-logo.png') !!}" width="200" /></a>
				</div>
			</div>

			<div class="signin-body">
				<div class="container">

					{!! Form::open(['role' => 'form', 'novalidate']) !!}

					<div class="form-container">

						<div class="progress-striped progress" type="success">
							<div id="progress" class="progress-bar progress-bar-success" style="width: 0%;"></div>
						</div>

						<fieldset id="slide1" class="wizard-slide first {{ $slide=='slide1' ? 'active' : 'closed' }}">
							<span class="text-center">
								<h2>Thank you for signing up!</h2>
								<p>To continue to create your account, please provide the following required information.</p>
							</span>

							<hr />

							<div class="form-group">
								<button type="button" class="btn btn-warning btn-lg btn-block slide-next" data-current="#slide1" data-next="#slide2" data-url="{{ url("register/$code") }}">Continue <i class="fa fa-arrow-right"></i></button>
							</div>

						</fieldset>

						<fieldset id="slide2" class="wizard-slide {{ $slide=='slide2' ? 'active' : 'closed' }}" data-slide-index="1">
							<h2>1. School Information</h2>
							<p>Pleade provide the following information about the school you represent.</p>
							<hr />
							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-building"></span>
									</span>
									{!! Form::hidden('step', 'school') !!}
									{!! Form::hidden('progress', 'slide2') !!}
									{!! Form::text('school_name', null, ['class' => 'form-control', 'placeholder' => 'Name of School']) !!}
								</div>
							</div>
							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-question"></span>
									</span>
									{!! Form::text('school_city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
								</div>
							</div>

							<div class="form-group condensed">
								<div class="input-group js-dropdown-select">
									<span class="input-group-addon">
										<span class="fa fa-question"></span>
									</span>
									{!! Form::dropdown('school_province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
								</div>
							</div>

							<hr />

							<div class="form-group">
								<button type="submit" class="btn btn-warning btn-lg pull-right submit-slide" data-current="#slide2" data-next="#slide3" data-url="{{ url("register/$code") }}">Continue <i class="fa fa-arrow-right"></i></button>
							</div>

						</fieldset>

						<fieldset id="slide3" class="wizard-slide {{ $slide=='slide3' ? 'active' : 'closed' }}" data-slide-index="2">
							<h2>2. School Board Information</h2>
							<p>Which School Board does your school fall under?</p>
							<hr />
							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-building"></span>
									</span>
									{!! Form::hidden('step', 'school_board') !!}
									{!! Form::hidden('progress', 'slide3') !!}
									{!! Form::text('school_board', null, ['class' => 'form-control', 'placeholder' => 'Name of School Board']) !!}
								</div>
							</div>

							<hr />

							<div class="form-group">
								<button type="button" class="btn btn-line-default btn-lg pull-left slide-back" data-current="#slide3" data-prev="#slide2"><i class="fa fa-arrow-left"></i> Back</button>
								<button type="submit" class="btn btn-warning btn-lg pull-right submit-slide" data-current="#slide3" data-next="#slide4" data-url="{{ url("register/$code") }}">Continue <i class="fa fa-arrow-right"></i></button>
							</div>

						</fieldset>

						<fieldset id="slide4" class="wizard-slide {{ $slide=='slide4' ? 'active' : 'closed' }}" data-slide-index="3">
							<h2>3. Principal Information</h2>
							<p>Please provide the following information about your school's principal.</p>
							<hr />
							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-question"></span>
									</span>
									{!! Form::hidden('step', 'principal') !!}
									{!! Form::hidden('progress', 'slide4') !!}
									{!! Form::text('principal.first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
								</div>
							</div>

							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-question"></span>
									</span>
									{!! Form::text('principal.last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
								</div>
							</div>

							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-envelope"></span>
									</span>
									{!! Form::text('principal.email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
								</div>
							</div>

							<hr />

							<div class="form-group">
								<button type="button" class="btn btn-line-default btn-lg pull-left slide-back" data-current="#slide4" data-prev="#slide3"><i class="fa fa-arrow-left"></i> Back</button>
								<button type="submit" class="btn btn-warning btn-lg pull-right submit-slide" data-current="#slide4" data-next="#slide5" data-url="{{ url("register/$code") }}">Continue <i class="fa fa-arrow-right"></i></button>
							</div>

						</fieldset>

						<fieldset id="slide5" class="wizard-slide {{ $slide=='slide5' ? 'active' : 'closed' }}" data-slide-index="4">
							<h2>4. Counsellor Information</h2>
							<p>Please provide the following information about your school's counsellor.</p>
							<hr />
							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-question"></span>
									</span>
									{!! Form::hidden('step', 'counsellor') !!}
									{!! Form::hidden('progress', 'slide5') !!}
									{!! Form::text('counsellor.first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
								</div>
							</div>

							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-question"></span>
									</span>
									{!! Form::text('counsellor.last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
								</div>
							</div>

							<div class="form-group condensed">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="fa fa-envelope"></span>
									</span>
									{!! Form::text('counsellor.email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
								</div>
							</div>

							<hr />

							<div class="form-group">
								<button type="button" class="btn btn-line-default btn-lg pull-left slide-back" data-current="#slide5" data-prev="#slide4"><i class="fa fa-arrow-left"></i> Back</button>
								<button type="submit" class="btn btn-warning btn-lg pull-right submit-slide" data-current="#slide5" data-next="#slide6" data-url="{{ url("register/$code") }}">Continue <i class="fa fa-arrow-right"></i></button>
							</div>

						</fieldset>

						<fieldset id="slide6" class="wizard-slide {{ $slide=='slide6' ? 'active' : 'closed' }}" data-slide-index="5">
							<h2>5. Teacher(s) Information</h2>
							<p>Please add the following information for all the teachers who require access.</p>
							<p><em>Note: You can also add more teachers at a later time.</em></p>
							<hr />

							<div id="teachersContainer">

								{!! Form::hidden('step', 'teachers') !!}
								{!! Form::hidden('progress', 'slide6') !!}

								@for ($i=1; $i<=$teachers; $i++)

									<div id="teacherInfo{{$i}}" class="teacher-info">

										<a href="#" class="pull-right js-remove" data-target="#teacherInfo{{$i}}" data-callback="$.front.updateTeachers"><i class="fa fa-minus"></i> Remove</a>
										<h4>Teacher no. <span data-num>{{$i}}</span></h4>
										<div class="form-group condensed">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="fa fa-question"></span>
												</span>
												{!! Form::text("teachers.$i.first_name", null, ['class' => 'form-control', 'placeholder' => 'First Name', 'data-single-name' => 'first_name']) !!}
											</div>
										</div>

										<div class="form-group condensed">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="fa fa-question"></span>
												</span>
												{!! Form::text("teachers.$i.last_name", null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'data-single-name' => 'last_name']) !!}
											</div>
										</div>

										<div class="form-group condensed">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="fa fa-envelope"></span>
												</span>
												{!! Form::text("teachers.$i.email", null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'data-single-name' => 'email']) !!}
											</div>
										</div>

										<hr />

									</div>

								@endfor

							</div>

							<a href="#" id="addTeacher" class="btn btn-line-default btn-lg btn-block js-add-template" data-template="#teacherTemplate" data-target="#teachersContainer" data-num="{{$teachers+1}}"><i class="fa fa-plus"></i> Add Teacher</a>

							<hr />

							<div class="form-group">
								<button type="button" class="btn btn-line-default btn-lg pull-left slide-back" data-current="#slide6" data-prev="#slide5"><i class="fa fa-arrow-left"></i> Back</button>
								<button type="submit" class="btn btn-warning btn-lg pull-right submit-slide" data-current="#slide6" data-next="#slide7" data-url="{{ url("register/$code") }}"><i class="fa fa-check"></i> Complete!</button>
							</div>

						</fieldset>

						<fieldset id="slide7" class="wizard-slide last {{ $slide=='slide7' ? 'active' : 'closed' }}">
							<span class="text-center">
								<h2>You're done!</h2>
								<p>You have successfully configured your school information. Thank you for completing the process.</p>
								<hr />
								<p><em>Note: Registration links have been sent to all users that was added during this process. Each user will have to configure their own access information.</em></p>
							</span>

							<hr />

							<div class="form-group">
								<a href="{{ url('login') }}" class="btn btn-warning btn-lg btn-block"><i class="fa fa-home"></i> Login</a>
							</div>

						</fieldset>

					</div>

				</div>
			</div>

		</div>

		<script type="text/template" id="teacherTemplate">

			<div id="teacherInfo{num}" class="teacher-info">

				<a href="#" class="pull-right js-remove" data-target="#teacherInfo{num}" data-callback="$.front.updateTeachers"><i class="fa fa-minus"></i> Remove</a>

				<h4>Teacher no. <span data-num>{num}</span></h4>

				<div class="form-group condensed">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="fa fa-question"></span>
						</span>
						{!! Form::hidden('step', 'teachers') !!}
						{!! Form::text('teachers.{num}.first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name', 'data-single-name' => 'first_name']) !!}
					</div>
				</div>

				<div class="form-group condensed">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="fa fa-question"></span>
						</span>
						{!! Form::text('teachers.{num}.last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'data-single-name' => 'last_name']) !!}
					</div>
				</div>

				<div class="form-group condensed">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="fa fa-envelope"></span>
						</span>
						{!! Form::text('teachers.{num}.email', null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'data-single-name' => 'email']) !!}
					</div>
				</div>

				<hr />

			</div>

		</script>
	@stop

