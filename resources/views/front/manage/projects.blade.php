@extends('common.layout.front')

	@section('title')
		Project
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				<br /><br />

				<div class="col-md-12">

					<!--<a href="#" id="btnImportStudents" class="btn btn-default btn-lg pull-right show-panel inline" data-target="#import" data-hide="#btnCreateSchool"><i class="fa fa-search"></i> View Reports</a>-->

					<a href="#" id="btnCreateSchool" class="btn btn-default btn-lg pull-right show-panel" data-target="#addProject" data-hide="#btnImportStudents"><i class="fa fa-plus"></i> Create Project</a>

					@if ($projects)

						<h1><a href="{{ url('m/projects/') }}">Projects</a></h1>

					@endif

					<hr />

				</div>

				@include('front.manage.sections.school_filters')

				<div id="projects" class="col-md-12 closable-panel open">
					<div class="panel panel-primary">
						<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Projects</strong></div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th><input type="checkbox" class="i-checks js-select-all"></th>
										<th>Project Name</th>
										<th>City</th>
										<th>Schools</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($projects as $project)
										<tr id="record-{{ $project->id }}">
											<td><input type="checkbox" class="i-checks js-select" data-record-id="{{ $project->id }}"></td>
											<td><a href="{{ url('m/projects/'.$project->id) }}">{{ $project->project_name }}</a></td>
											<td><a href="{{ url('m/projects/'.$project->id) }}">{{ $project->city }}</a></td>
											<td>
												<a href="{{ url('m/projects/schools/'.$project->id) }}" class="btn btn-sm btn-default">{{ $project->school_count }} Schools</a>
											</td>
											<td>
												<a href="#" class="btn btn-xs btn-default show-panel" data-target="#updateProjects{{$project->id}}"><i class="fa fa-pencil"></i></a>
												<a href="{{ url('m/projects/'.$project->id.'/remove') }}" class="btn btn-xs btn-default js-post-remove"><i class="fa fa-times"></i></a>
												<a href="#" class="btn btn-xs btn-default">Create Report</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<!--<div class="pull-right"><a href="#" class="btn btn-default btn-md pull-right"> Next <i class="fa fa-arrow-right"></i></a> </div>-->
						</div>
					</div>

				</div>

				<div id="addProject" class="col-md-12 closable-panel closed">

					<div class="panel-group class-panel">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Create Project
							</div>
							<div class="panel-body">
								{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/projects/add"]) !!}

								<br />

								<h4>Project Information</h4>

								<hr />

								<div class="form-group">
									<label class="col-sm-2">Project Name</label>
									<div class="col-sm-8">
										{!! Form::text('project_name', null, ['class' => 'form-control', 'placeholder' => 'Project Name']) !!}
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2">Email</label>
									<div class="col-sm-8">
										{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2">Street</label>
									<div class="col-sm-8">
										{!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Address Street']) !!}
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2">City</label>
									<div class="col-sm-8">
										{!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2">Province</label>
									<div class="col-sm-8">
										<div class="js-dropdown-select padded">
											{!! Form::dropdown('province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2">Country</label>
									<div class="col-sm-8">
										{!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2">Postal Code</label>
									<div class="col-sm-8">
										{!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}
									</div>
								</div>

								<hr />

								<a href="#" class="btn btn-default btn-lg show-panel dont-activate" data-target="#projects">Cancel</a>

								<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> Save Changes</button>

								{!! Form::close() !!}
							</div>
						</div>

					</div>

				</div>

				@foreach ($projects as $project)


					<div id="updateProjects{{$project->id}}" class="col-md-12 closable-panel closed">

						<div class="panel-group class-panel">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Update Project
								</div>
								<div class="panel-body">
									{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/projects/$project->id/update", 'data-return-url' => url("/m/projects")   ]) !!}

									<br />

									<h4>Project Information</h4>

									<hr />

									<div class="form-group">
										<label class="col-sm-2">Project Name</label>
										<div class="col-sm-8">
											{!! Form::text('project_name', $project->project_name, ['class' => 'form-control', 'placeholder' => 'Project Name']) !!}
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2">Email</label>
										<div class="col-sm-8">
											{!! Form::text('email', $project->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Street</label>
										<div class="col-sm-8">
											{!! Form::text('street', $project->street, ['class' => 'form-control', 'placeholder' => 'Address Street']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">City</label>
										<div class="col-sm-8">
											{!! Form::text('city', $project->city, ['class' => 'form-control', 'placeholder' => 'City']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Province</label>
										<div class="col-sm-8">
											<div class="js-dropdown-select padded">
												{!! Form::dropdown('province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], $project->province, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Country</label>
										<div class="col-sm-8">
											{!! Form::text('country', $project->address_country, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Postal Code</label>
										<div class="col-sm-8">
											{!! Form::text('postal_code', $project->postal_code, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}
										</div>
									</div>

									<hr />

									<a href="#" class="btn btn-default btn-lg show-panel dont-activate" data-target="#projects" >Cancel</a>

									<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> Save Changes</button>

									{!! Form::close() !!}
								</div>
							</div>

						</div>

					</div>




				@endforeach

			</div>

		</div>

		<script>
			var activeSection = "{{ \Input::get('s') }}";
		</script>

		
	@stop

	@section('script')
		<script type="text/javascript">
			$('.search-box').find('input').on('keyup',function(e){
				if (e.which == 13) {
					$('.search-box').submit();
				}
			});
			
		</script>
	@stop

@stop