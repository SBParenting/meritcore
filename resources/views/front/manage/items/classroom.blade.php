<div class="col-md-4 class-panel closable-panel open">

	<div class="panel-group class-panel">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<i class="fa fa-bars"></i> {{ $class->title }}
			</div>
			<div class="panel-body">
				<ul class="list-unstyled list-info">
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
						@if ($class->grade)
							{{ $class->grade }}
						@else
							--
						@endif
					</li>
					<li>
						<label>No. of students</label>
						{{ $class->students_count }}
					</li>
					<li>
						<label>Status</label>
						@if ($class->status == 'Active')
							<span class="label label-info">{{ $class->status }}</span>
						@else
							<span class="label label-default">{{ $class->status }}</span>
						@endif
					</li>
					<li class="progress-field">
						<label class="pull-left">Active survey</label>
						@if ($class->is_survey_active)
							<div class="progress progressbar-xs">
								<div class="progress-bar progress-bar-info" style="width: {{ $class->survey_progress }}%;"></div>
							</div>
							<p class="progress-subscript">{{ $class->survey_progress }}% Complete</p>
						@else
							<em>None</em>
						@endif
					</li>
					<!--<li>
						<label>Completed Surveys</label>
						{{ App\Models\Campaign::where('class_id',$class->id)->where('status','Completed')->count() }}
					</li>-->
				</ul>
				<a href="{{ url('m/classes/'.$class->id) }}" class="btn btn-block btn-line-default">View Class</a>
			</div>
		</div>
	</div>
</div>