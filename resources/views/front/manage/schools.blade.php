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

					<a href="#" id="btnImportStudents" class="btn btn-info btn-lg pull-right show-panel" data-target="#import"><i class="fa fa-upload"></i> Import Students</a>

					@if ($school_board)

						<h1><a href="{{ url('m/schools/') }}">{{ $school_board->name }}</a></h1>

					@endif

					<hr />

				</div>

				@include('front.manage.sections.school_filters')

				<div class="col-md-12 closable-panel open">
					<div class="panel panel-default">
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
		</script

	@stop

@stop