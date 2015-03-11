@extends('common.layout.front')

	@section('title')
		Schools
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				@include('front.manage.partials.nav')

				<div class="col-md-12 contain">

					@if ($is_admin)

						<h3 class="pull-left"><a href="{{ url('m/schools/'.$school->id) }}">{{ $school->name }}</a></h3>

					@else

						<h3 class="pull-left"><a href="{{ url('m/classes/') }}">{{ $school->name }}</a></h3>

					@endif

					<h3 class="pull-left divider"><i class="fa fa-caret-right"></i></h3>

					<h3 class="pull-left"><a href="{{ url('m/classes/'.$class->id) }}">{{ $class->title }}</a></h3>

					<br />

					<a href="{{ url('/m/classes') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back to Classes</a>

				</div>


				<div class="col-md-12">
					<hr />
				</div>

				<div class="col-md-4">

					<div id="studentInfoPanel" class="panel-group class-panel closable-panel open">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-th-large"></i>STUDENTS
							</div>
							<div class="panel-body">

								<div class="giant-count">
									<span class="num">{{ count($students) }}</span> {{ str_plural('Student', count($students)) }}
								</div>

								<a href="#" id="btnManageStudents" class="btn btn-block btn-line-info show-panel" data-target="#students" data-show="#studentInfoPanel">Manage Students</a>
								<br />
							</div>

						</div>

					</div>

					<div id="surveyInfoPanel" class="panel-group class-panel closable-panel closed">

						<div class="panel panel-default">

							<div class="panel-heading">
								<i class="fa fa-th-large"></i>SURVEYS
							</div>
							<div class="panel-body">

								<a href="#" id="btnManageSurveys" class="btn btn-block btn-line-info active hide-panel"><i class="fa fa-arrow-left"></i> Go Back</a>
							</div>
						</div>
					</div>

					<div id="classInfoPanel" class="panel-group class-panel closable-panel open">

						<div class="panel panel-default">

							<div class="panel-heading">
								<i class="fa fa-th-large"></i>Class Information
							</div>

							<div class="panel-body">
								<ul class="list-unstyled list-info">
									<li>
										<label>Title</label>
										{{ $class->title }}
									</li>
									<li>
										<label>School</label>
										{{ $school->name }}
									</li>
									<li>
										<label>Teacher</label>
										@if ($class->teacher)
											{{ $class->teacher->getName('F L') }}
										@else
											--
										@endif
									</li>
									<li>
										<label>Grade</label>
										{{ $class->grade }}
									</li>
								</ul>

								<a href="{{ url('m/classes/'.$class->id) }}" id="btnUpdateClassInfo" class="btn btn-block btn-line-info show-panel" data-target="#class" data-show="#classInfoPanel">Update Class Information</a>
								<br />
							</div>
						</div>
					</div>

					@if ($active_survey)
						<div id="surveyInfoPanel{{$active_survey->id}}" class="panel-group class-panel closable-panel closed">

							<div class="panel panel-default">

								<div class="panel-heading">
									<i class="fa fa-th-large"></i>SURVEY
								</div>
								<div class="panel-body">

									<a href="#" class="btn btn-block btn-line-info active hide-panel"><i class="fa fa-arrow-left"></i> Go Back</a>

									<hr />

									<h4>Share this link</h4>

									{!! Form::text('link', url($active_survey->secret), ['class' => 'form-control']) !!}

									<hr />

									<ul class="list-unstyled list-info">
										<li>
											<label>Title</label>
											{{ $active_survey->title }}
										</li>
										<li>
											<label>Questionaire</label>
											{{ $active_survey->survey->title }}
										</li>
										<li>
											<label>Created</label>
											{{ get_date($active_survey->created_at, "j F, Y") }}
										</li>
										<li>
											<label>Survey Progress</label>
											@if ($active_survey->status)
												<div class="progress progress-striped" style="margin-left:0">
													<div class="progress-bar progress-bar-info" style="width: {{ $active_survey->started_progress }}%;"></div>
													<div class="progress-bar progress-bar-warning" style="width: {{ $active_survey->completed_progress }}%;"></div>
												</div>

												<p class="progress-subscript" style="margin-left:0">{{ $active_survey->started_progress }}% Started, {{ $active_survey->completed_progress }}% Completed ( {{ $active_survey->count_started }} Started, {{ $active_survey->count_completed }} Completed, {{ $active_survey->count_total }} Total)</p>
											@else
												<em>None</em>
											@endif
										</li>
									</ul>

								</div>
							</div>
						</div>

					@endif

					@foreach ($surveys as $survey)

						<div id="surveyInfoPanel{{$survey->id}}" class="panel-group class-panel closable-panel closed">

							<div class="panel panel-default">

								<div class="panel-heading">
									<i class="fa fa-th-large"></i>SURVEY
								</div>
								<div class="panel-body">

									<a href="#" class="btn btn-block btn-line-info active hide-panel"><i class="fa fa-arrow-left"></i> Go Back</a>

									<hr />

									<ul class="list-unstyled list-info">
										<li>
											<label>Title</label>
											{{ $survey->title }}
										</li>
										<li>
											<label>Questionaire</label>
											{{ $survey->survey->title }}
										</li>
										<li>
											<label>Created</label>
											{{ get_date($survey->created_at, "j F, Y") }}
										</li>
										<li>
											<label>Survey Progress</label>
											@if ($survey->status)
												<div class="progress progress-striped" style="margin-left:0">
													<div class="progress-bar progress-bar-info" style="width: {{ $survey->started_progress }}%;"></div>
													<div class="progress-bar progress-bar-warning" style="width: {{ $survey->completed_progress }}%;"></div>
												</div>

												<p class="progress-subscript" style="margin-left:0">{{ $survey->started_progress }}% Started, {{ $survey->completed_progress }}% Completed ( {{ $survey->count_started }} Started, {{ $survey->count_completed }} Completed, {{ $survey->count_total }} Total)</p>
											@else
												<em>None</em>
											@endif
										</li>
									</ul>

								</div>
							</div>
						</div>

					@endforeach


				</div>

				<div class="col-md-8">

					<div id="surveys" class="closable-panel open">

						@if (count($surveys) > 0 || $active_survey)

							@if ($active_survey)

								<div class="panel-group class-panel">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4>ACTIVE SURVEY</h4>
										</div>
										<div class="panel-body">

											<h4>Share this link</h4>

											{!! Form::text('link', url($active_survey->secret), ['class' => 'form-control']) !!}

											<br />
											<em>Note: Each participating student must provide their Name and Student ID when starting the survey.</em>

											<hr />

											<ul class="list-unstyled list-info">
												<li>
													<label>Title</label>
													{{ $active_survey->title }}
												</li>
												<li>
													<label>Questionaire</label>
													{{ $active_survey->survey->title }}
												</li>
												<li>
													<label>Created</label>
													{{ get_date($active_survey->created_at, "j F, Y") }}
												</li>
												<li class="progress-field">
													<label class="pull-left">Survey Progress</label>
													@if ($active_survey->status)
														<div class="progress progress-striped">
															<div class="progress-bar progress-bar-info" style="width: {{ $active_survey->started_progress }}%;"></div>
															<div class="progress-bar progress-bar-warning" style="width: {{ $active_survey->completed_progress }}%;"></div>
														</div>

														<p class="progress-subscript">{{ $active_survey->started_progress }}% Started, {{ $active_survey->completed_progress }}% Completed ( {{ $active_survey->count_started }} Started, {{ $active_survey->count_completed }} Completed, {{ $active_survey->count_total }} Total)</p>
													@else
														<em>None</em>
													@endif
												</li>
											</ul>
											<a href="#" class="btn btn-block btn-line-default show-panel" data-target="#manageSurvey{{$active_survey->id}}" data-show="#surveyInfoPanel{{$active_survey->id}}">View / Manage Survey</a>
										</div>
									</div>
								</div>

								<hr />

								<div class="panel-group class-panel">
									<div class="panel panel-default">
										<div class="panel-body">
											<em>Note: You can only have one Active survey in a class. To start another survey, please mark the Active survey as Complete, by clicking 'View / Manage Survey'.</em>
										</div>
									</div>
								</div>

							@else

								<div class="panel-group class-panel">
									<div class="panel panel-default">
										<div class="panel-heading">
											<button class="btn btn-block btn-line-info giant show-panel" data-target="#addSurvey" data-show="#surveyInfoPanel"><i class="glyphicon glyphicon-plus"></i> Start New Survey</button>
										</div>
									</div>
								</div>

								<hr />

							@endif

							@if (count($surveys) > 0)

								<h1>Completed Surveys</h1>

								<hr />

								@foreach ($surveys as $survey)

									<div class="panel-group class-panel">
										<div class="panel panel-default">
											<div class="panel-heading">
												{{ $survey->status }} Survey
											</div>
											<div class="panel-body">
												<ul class="list-unstyled list-info">
													<li>
														<label>Title</label>
														{{ $survey->title }}
													</li>
													<li>
														<label>Questionaire</label>
														{{ $survey->survey->title }}
													</li>
													<li>
														<label>Created</label>
														{{ get_date($survey->created_at, "j F, Y") }}
													</li>
													<li>
														<label class="pull-left">Survey Results</label>
														<em>{{ $survey->count_completed }} students completed survey.</em>
													</li>
												</ul>
												<a href="{{ url('m/classes/'.$class->id) }}" class="btn btn-block btn-line-default show-panel" data-target="#manageSurvey{{$survey->id}}" data-show="#surveyInfoPanel{{$survey->id}}">View Survey Results</a>
											</div>
										</div>
									</div>

								@endforeach

							@endif

						@else

							<div class="panel-group class-panel">
								<div class="panel panel-default">
									<div class="panel-heading">
										<button class="btn btn-block btn-line-info giant show-panel" data-target="#addSurvey" data-show="#surveyInfoPanel"><i class="glyphicon glyphicon-plus"></i> Start New Survey</button>
									</div>
								</div>
							</div>

							<hr />

							<h3 class="text-center"><em>No Surveys Yet..</em></h3>

						@endif

					</div>

					<div id="students" class="closed closable-panel">

						<div class="panel-group class-panel">
							<div class="panel panel-default">
								<div class="panel-heading">
									Students
								</div>
								<div class="panel-body">
									@if (count($students) == 0)
										<h1>No Students Yet..</h1>
									@else
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Student Name</th>
													<th>ID</th>
													<th>Date of Birth</th>
													<th>City</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($students as $num => $student)
													<tr>
														<td class="text-info">{{ $num+1 }}</td>
														<td>{{ $student->getName("F L") }}</td>
														<td>{{ $student->sid }}</td>
														<td>{{ get_date($student->date_birth, "j M, Y") }}</td>
														<td>{{ $student->address_city }}</td>
														<td>
															<a href="#" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endif
									<hr />
									<button class="btn btn-line-default show-panel dont-activate" id="btnAddStudent" data-target="#addStudent" data-show="#studentInfoPanel"><i class="fa fa-plus"></i> Create Student</button>
								</div>
							</div>
						</div>

					</div>

					<div id="class" class="closed closable-panel">
						<div class="panel-group class-panel">
							<div class="panel panel-default">
								<div class="panel-heading">
									Class Information
								</div>
								<div class="panel-body">
									{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/classes/$class->id/info", 'data-return-url' => url("/m/classes/$class->id") ]) !!}

										{!! Form::hidden('school_id', $school->id) !!}
										{!! Form::hidden('class_id', $class->id) !!}

										<br />

										<h4>Class Information</h4>

										<hr />

										<div class="form-group">
											<label class="col-sm-2">Title</label>
											<div class="col-sm-8">
												{!! Form::text('title', $class->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Grade</label>
											<div class="col-sm-8">
												<div class="js-dropdown-select padded">
													{!! Form::dropdown('grade', $grades, $class->grade, ['class' => 'form-control', 'placeholder' => 'Grade'], 'btn btn-default') !!}
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Teacher</label>
											<div class="col-sm-8">
												<div class="js-dropdown-select padded">
													{!! Form::dropdown('teacher_id', make_assoc_from_model($teachers, 'id', 'name'), $class->teacher_id, ['class' => 'form-control', 'placeholder' => 'Teacher'], 'btn btn-default') !!}
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2"></label>
											<div class="col-sm-8 text-center">
												OR CREATE NEW TEACHER
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">First Name</label>
											<div class="col-sm-8">
												{!! Form::text('teacher_first_name', null, ['class' => 'form-control', 'placeholder' => 'Teacher First Name']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Last Name</label>
											<div class="col-sm-8">
												{!! Form::text('teacher_last_name', null, ['class' => 'form-control', 'placeholder' => 'Teacher Last Name']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Email</label>
											<div class="col-sm-8">
												{!! Form::text('teacher_email', null, ['class' => 'form-control', 'placeholder' => 'Teacher Email']) !!}
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


					<div id="addStudent" class="closed closable-panel">
						<div class="panel-group class-panel">
							<div class="panel panel-default">
								<div class="panel-heading">
									Create Student
								</div>
								<div class="panel-body">
									{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/classes/$class->id/students/add", 'data-return-url' => url("/m/classes/$class->id")."?s=1"   ]) !!}

										{!! Form::hidden('school_id', $school->id) !!}
										{!! Form::hidden('class_id', $class->id) !!}

										<br />

										<h4>Student Information</h4>

										<hr />

										<div class="form-group">
											<label class="col-sm-2">Student ID</label>
											<div class="col-sm-8">
												{!! Form::text('sid', null, ['class' => 'form-control', 'placeholder' => 'Student ID']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">First Name</label>
											<div class="col-sm-8">
												{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2">Last Name</label>
											<div class="col-sm-8">
												{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2">Date of Birth</label>
											<div class="col-sm-8">
												<div class="input-group date">
													{!! Form::text('date_birth', null, ['class' => 'form-control', 'placeholder' => 'Date of Birth']) !!}
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
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
											<label class="col-sm-2">Email</label>
											<div class="col-sm-8">
												{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
											</div>
										</div>

										<br />

										<h4>Address Information</h4>

										<hr />

										<div class="form-group">
											<label class="col-sm-2">Street</label>
											<div class="col-sm-8">
												{!! Form::text('address_street', null, ['class' => 'form-control', 'placeholder' => 'Address Street']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">City</label>
											<div class="col-sm-8">
												{!! Form::text('address_city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Province</label>
											<div class="col-sm-8">
												<div class="js-dropdown-select padded">
													{!! Form::dropdown('address_province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Country</label>
											<div class="col-sm-8">
												{!! Form::text('address_country', null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Postal Code</label>
											<div class="col-sm-8">
												{!! Form::text('address_postal_code', null, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}
											</div>
										</div>

										<hr />

										<a href="#" class="btn btn-default btn-lg show-panel dont-activate" data-target="#students" data-show="#studentInfoPanel" >Cancel</a>

										<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> Save Changes</button>

									{!! Form::close() !!}
								</div>
							</div>

						</div>
					</div>


					<div id="addSurvey" class="closed closable-panel">
						<div class="panel-group class-panel">
							<div class="panel panel-default">
								<div class="panel-heading">
									Add Survey
								</div>
								<div class="panel-body">
									{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/classes/$class->id/surveys/add", 'data-return-url' => url("/m/classes/$class->id")   ]) !!}

										{!! Form::hidden('school_id', $school->id) !!}
										{!! Form::hidden('class_id', $class->id) !!}

										<br />

										<h4>Survey Information</h4>

										<hr />

										<div class="form-group">
											<label class="col-sm-2">Title</label>
											<div class="col-sm-8">
												{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2">Questionaire</label>
											<div class="col-sm-8">
												<div class="js-dropdown-select padded">
													{!! Form::dropdown('survey_id', make_assoc_from_model($survey_types, 'id', 'title'), null, ['class' => 'form-control', 'placeholder' => 'Questionaire'], 'btn btn-default') !!}
												</div>
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

					@if ($active_survey)

						<div id="manageSurvey{{$active_survey->id}}" class="closed closable-panel">
							<div class="panel-group class-panel">
								<div class="panel panel-default">
									<div class="panel-heading">
										Manage Survey
									</div>
									<div class="panel-body">

										{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/classes/$class->id/surveys/$active_survey->id/complete", 'data-return-url' => url("/m/classes/$class->id") ]) !!}

											<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> End Survey!</button>

										{!! Form::close() !!}

										<br />

										<h4>Survey Participants</h4>

										<hr />

										@if (count($active_survey->students) == 0)
											<h4>No Students In This Survey Yet..</h4>
										@else
											<table class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>Student Name</th>
														<th>Status</th>
														<th>Progress</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($active_survey->students as $num => $student)
														<tr>
															<td class="text-info">{{ $num+1 }}</td>
															<td>{{ $student->student->getName("F L") }}</td>
															<td>{{ $student->status }}</td>
															<td>
																<div class="progress progress-striped">
																	<div class="progress-bar progress-bar-info" style="width: {{ $student->getProgress() }}%;">
																		{{ $student->count_completed }} of {{ $student->count_total }}
																	</div>
																</div>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										@endif

									</div>

								</div>

							</div>
						</div>

					@endif

					@foreach ($surveys as $survey)

						<div id="manageSurvey{{$survey->id}}" class="closed closable-panel">
							<div class="panel-group class-panel">
								<div class="panel panel-default">
									<div class="panel-heading">
										Survey Results
									</div>
									<div class="panel-body">

										<a href="{{ url('/m/surveys/'.$survey->id.'/report') }}" class="btn btn-default btn-lg pull-right" target="_blank"><i class="fa fa-bar-chart"></i> Generate Survey Report</a>

										<br />

										<h4>Survey Summary</h4>

										<hr />

										<ul class="list-unstyled list-info">
											<li>
												<label>Participants</label>
												{{ $survey->count_total }}
											</li>
											<li>
												<label>Questions</label>
												{{ $survey->survey->count_questions }}
											</li>
											<li>
												<label>Date Started</label>
												9 Jan 2015
											</li>
											<li>
												<label>Date Ended</label>
												15 Feb 2015
											</li>
										</ul>

										<br /><br />

										<h4>Survey Results</h4>

										<hr />

										<ul class="list-unstyled list-info">
											@foreach ($survey->stats as $num => $row)
												<li>
													<span class="pull-left">{{$num+1}}. {{$row->grouping->title}}</span>
													<div class="progress progress-striped" style="margin: 0 0 5px 200px;">
														<div class="progress-bar progress-bar-danger" style="width: {{$row->strong_percentage}}%;">{{ $row->strong_count }}</div>
														<div class="progress-bar progress-bar-info" style="width: {{$row->vulnerable_percentage}}%;">{{ $row->vulnerable_count }}</div>
													</div>
												</li>
											@endforeach
										</ul>

									</div>

								</div>

							</div>
						</div>

					@endforeach

				</div>

			</div>

		</div>

		<script>
			var activeSection = "{{ \Input::get('s') }}";
		</script>

	@stop

@stop