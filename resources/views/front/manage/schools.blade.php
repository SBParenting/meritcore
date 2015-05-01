@extends('common.layout.front')

	@section('title')
		Schools
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				<br /><br />

				<div class="col-md-12">

					<a href="#" id="btnImportStudents" class="btn btn-default btn-lg pull-right show-panel inline" data-target="#import" data-hide="#btnCreateSchool"><i class="fa fa-upload"></i> Import Students</a>

					<a href="#" id="btnCreateSchool" class="btn btn-default btn-lg pull-right show-panel" data-target="#addSchool" data-hide="#btnImportStudents"><i class="fa fa-plus"></i> Create School</a>

					@if ($school_board)

						<h1><a href="{{ url('m/schools/') }}">{{ $school_board->name }}</a></h1>

					@endif

					<hr />

				</div>

				@include('front.manage.sections.school_filters')

				<div id="schools" class="col-md-12 closable-panel open">
					<div class="panel panel-primary">
						<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Schools</strong></div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>School Name</th>
										<th>City</th>
										<th>Classes</th>
										<th>Students</th>
										<th>Surveys</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($schools as $school)
										<tr>
											<td><a href="{{ url('m/schools/'.$school->id) }}">{{ $school->name }}</a></td>
											<td><a href="{{ url('m/schools/'.$school->id) }}">{{ $school->address_city }}</a></td>
											<td>
												<a href="{{ url('m/schools/'.$school->id) }}" class="btn btn-sm btn-default">{{ $school->classes_count }} Classes</a>
											</td>
											<td>
												<a href="{{ url('m/students/'.$school->id) }}" class="btn btn-sm btn-default">{{ $school->students_count }} Students</a>
											</td>
											<td>
												@if ($school->surveys_active_count > 0)
													<a href="{{ url('m/surveys/'.$school->id) }}" class="btn btn-sm btn-default">{{ $school->surveys_active_count }} Active Surveys</a>
												@else
													<a href="{{ url('m/surveys/'.$school->id) }}" class="btn btn-sm btn-default">{{ $school->surveys_total_count }} Completed Surveys</a>
												@endif
											</td>
											<td>
												<a href="#" class="btn btn-xs btn-default show-panel" data-target="#updateSchool{{$school->id}}"><i class="fa fa-pencil"></i></a>

												@if ($school->classes_count + $school->students_count + $school->surveys_total_count == 0)
													<a href="{{ url('m/schools/'.$school->id.'/remove') }}" class="btn btn-xs btn-default js-post-remove"><i class="fa fa-times"></i></a>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

				</div>

				<div id="import" class="col-md-12 closable-panel closed">
					<div id="btnImport" class="panel panel-default">
						<div class="panel-heading">
							<span class="btn btn-block btn-line-default giant fileinput-button" style="text-transform: none">
								<i class="fa fa-file-excel-o"></i> Upload XLS File
								<input id="importFile" type="file" name="files[]" data-url="{{ url('m/import/') }}" multiple>
							</span>
						</div>
					</div>

					<div id="importProgressContainer" class="panel panel-default closed">
						<div class="panel-body">
							<h3 class="title"></h3>
							<hr />
							<div class="progress-striped progress" type="success">
								<div id="importProgress" class="progress-bar progress-bar-success" style="width: 0%;"></div>
							</div>
						</div>
					</div>

					<div id="importProcess" class="panel panel-default closed" data-url="{{ url('m/import/process') }}">
						<div class="panel-body">
							<h3 class="title">Analyzing imported file, please wait...</h3>
							<hr />
							<div class="giant-icon text-center"><i class="fa fa-cog fa-spin"></i></div>
						</div>
					</div>
				</div>

				<div id="importMatch" class="closed">
					{!! Form::open(['id' => 'importForm', 'url' => url("m/import/complete"), 'data-callback' => '$.manage.showImportProcess' , 'data-callback-error' => '$.manage.showMatchColumns' ]) !!}
						<div class="col-md-12">
							<p>Match the imported columns to the student information fields on the system.</p>
							<hr />
							{!! Form::hidden('filename', null) !!}
						</div>
						<div id="importMatchConatiner"></div>
						<div class="col-md-12 text-right">
							<hr />
							<button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Complete Import Process</button>
						</div>
					{!! Form::close() !!}
				</div>

				<div id="addSchool" class="col-md-12 closable-panel closed">

					<div class="panel-group class-panel">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Create School
							</div>
							<div class="panel-body">
								{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/schools/add", 'data-return-url' => url("/m/schools")   ]) !!}

								{!! Form::hidden('school_board_id', $school_board->id) !!}

								<br />

								<h4>School Information</h4>

								<hr />

								<div class="form-group">
									<label class="col-sm-2">School Name</label>
									<div class="col-sm-8">
										{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'School Name']) !!}
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

								<a href="#" class="btn btn-default btn-lg show-panel dont-activate" data-target="#schools" data-show="#btnImportStudents" >Cancel</a>

								<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> Save Changes</button>

								{!! Form::close() !!}
							</div>
						</div>

					</div>

				</div>

				@foreach ($schools as $school)


					<div id="updateSchool{{$school->id}}" class="col-md-12 closable-panel closed">

						<div class="panel-group class-panel">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Update School
								</div>
								<div class="panel-body">
									{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/schools/$school->id/update", 'data-return-url' => url("/m/schools")   ]) !!}

									<br />

									<h4>School Information</h4>

									<hr />

									<div class="form-group">
										<label class="col-sm-2">School Name</label>
										<div class="col-sm-8">
											{!! Form::text('name', $school->name, ['class' => 'form-control', 'placeholder' => 'School Name']) !!}
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2">Email</label>
										<div class="col-sm-8">
											{!! Form::text('email', $school->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Street</label>
										<div class="col-sm-8">
											{!! Form::text('address_street', $school->address_street, ['class' => 'form-control', 'placeholder' => 'Address Street']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">City</label>
										<div class="col-sm-8">
											{!! Form::text('address_city', $school->address_city, ['class' => 'form-control', 'placeholder' => 'City']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Province</label>
										<div class="col-sm-8">
											<div class="js-dropdown-select padded">
												{!! Form::dropdown('address_province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], $school->address_province, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Country</label>
										<div class="col-sm-8">
											{!! Form::text('address_country', $school->address_country, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2">Postal Code</label>
										<div class="col-sm-8">
											{!! Form::text('address_postal_code', $school->address_postal_code, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}
										</div>
									</div>

									<hr />

									<a href="#" class="btn btn-default btn-lg show-panel dont-activate" data-target="#schools" data-show="#btnImportStudents" >Cancel</a>

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

		<script type="text/template" id="columnTemplate">
			<div class="col-md-3">
				<div class="panel panel-default (data:matchclass)">
					<div class="panel-heading text-right">
						<span class="match-label label label-(data:matchclass)">(data:matched)</span>								
					</div>
					<div class="panel-body">
						<h4>(data:key)</h4>
						<hr />
						<div class="js-dropdown-select dropdown-relative match-field">
							{!! Form::dropdown("fields[(data:key)]", array_merge(make_assoc($fields), ['null' => "--", 'skip' => "Skip This Column"]), '(data:value)', ['class' => 'form-control', 'placeholder' => 'Select Field'], 'btn btn-default') !!}
						</div>
						<div class="clearfix"><br /></div>
						<div style="overflow:hidden">
							<table class="table table-striped">
								<tbody>
									<tr>
										<td>(data:row0)</td>
									</tr>
									<tr>
										<td>(data:row1)</td>
									</tr>
									<tr>
										<td>(data:row2)</td>
									</tr>
									<tr>
										<td>(data:row3)</td>
									</tr>
								</tbody>
							</table>	
						</div>							
					</div>
				</div>

			</div>
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