<div class="col-md-4 class-panel closable-panel open">

	<div class="panel-group class-panel">
		<div class="panel panel-default">
			<div class="panel-heading">
				Class <i class="fa fa-caret-right"></i>
				<strong>
					{{ $class->title }}
				</strong>
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
						{{ $class->count_students }}
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
				</ul>
				<a href="{{ url('m/classes/'.$class->id) }}" class="btn btn-block btn-line-default">View Class</a>
			</div>
		</div>
	</div>
</div>