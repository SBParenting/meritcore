@extends('common.layout.front')

	@section('title')
		Students
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				@include('front.manage.partials.nav')

				<div class="col-md-12">

                    <h1>{{ $school->name }}</h1>

					<hr />

					<div class="js-show-on-select">
						<div class="dropdown-relative dropdown-lg">
		                    <button data-toggle="dropdown" class="btn btn-default btn-lg dropdown-toggle"><i class="glyphicon glyphicon-plus"></i> Add To Classroom <i class="fa fa-caret-down pull-right"></i></button>
                            <ul class="dropdown-menu">
                            	@foreach ($classes as $class)
                            		<li><a href="{{ url('/m/students/'.$school->id.'/class/'.$class->id) }}" class="js-post-bulk">{{$class->title}}</a></li>
                            	@endforeach
                            </ul>
		                </div>
		                <br /><br /><hr />
	                </div>

				</div>

				<div class="col-md-12 closable-panel open">
					<div class="panel panel-primary">
						<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Students</strong></div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											<input type="checkbox" class="i-checks js-select-all">
										</th>
										<th>Student ID</th>
										<th>Student Name</th>
										<th>Class</th>
										<th>Email</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students as $student)
										<tr>
											<td>
												@if (empty($student->clasr))
													<input name="students[{{$student->id}}]" type="checkbox" class="i-checks js-select" data-record-id="{{ $student->id }}" value="1">
												@endif
											</td>
											<td>{{ $student->sid }}</td>
											<td>{{ $student->getName() }}</td>
											<td>
												@if ($student->clasr)
													{{ $student->clasr->title }}
												@else
													--
												@endif
											</td>
											<td>{{ $student->email }}</td>
											<td></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

				</div>

			</div>

		</div>

	@stop

@stop