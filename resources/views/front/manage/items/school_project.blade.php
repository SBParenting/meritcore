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

					<a href="#" id="btnCreateSchool" class="btn btn-default btn-lg pull-right show-panel" data-target="#addSchool"><i class="fa fa-plus"></i>Add School</a>

					<h1><a href="{{ url('m/projects/') }}">Projects</a>&nbsp;/&nbsp;{{$project_name}}</h1>

					<hr />

				</div>

				@include('front.manage.sections.school_filters')
				{!! Form::hidden('project_id', $project_id) !!}
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
												<a href="{{ url('m/projects/schools/'.$school->id.'/remove/'.$project_id) }}" class="btn btn-xs btn-default js-post-remove"><i class="fa fa-times"></i></a>
												<a href="#" class="btn btn-xs btn-default">Create Report</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div id="addSchool" class="col-md-12 closable-panel closed">
					<div class="panel-group class-panel">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Add School
							</div>
							<div class="panel-body">
								{!! Form::open(['class'=>'form-horizontal', 'url' => "/m/projects/schools/".$project_id."/add", 'data-return-url' => url("/m/projects/schools/".$project_id)   ]) !!}

								{!! Form::hidden('project_id', $project_id) !!}

								<br />

								<h4>Schools</h4>

								<hr />

								@foreach($school_list as $key => $value)
								<div class="form-group">
									<label class="col-sm-1"><input id='school_id[]' name='school_id[]' type="checkbox" class="i-checks js-select" data-record-id="{{ $key }}" {!! (in_array($key,$schoolIds))?"checked":"" !!} value="{{$key}}"></label>
									<div class="col-sm-8">
										{!! $value !!}
									</div>
								</div>
								@endforeach
								<hr />

								<a href="#" class="btn btn-default btn-lg show-panel dont-activate" data-target="#schools" data-show="#btnImportStudents" >Cancel</a>

								<button type="submit" class="btn btn-warning btn-lg pull-right"><i class="fa fa-check"></i> Save Changes</button>

								{!! Form::close() !!}
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>

		<script>
			var activeSection = "{{ \Input::get('s') }}";
		</script>

	@stop

	@section('script')
		<script type="text/javascript">
			$(document).ready(function(){
				var schoolCount = {!! count($schoolIds) !!};
				if(schoolCount<=0){
					$("#btnCreateSchool").trigger("click");
				}
			});
			$('.search-box').find('input').on('keyup',function(e){
				if (e.which == 13) {
					$('.search-box').submit();
				}
			});
		</script>
	@stop

@stop