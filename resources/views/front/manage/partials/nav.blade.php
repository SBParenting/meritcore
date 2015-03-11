
<div class="col-md-12">
	<ul class="top-nav">
		@if ($is_admin)
			<li><a href="{{ url('/m/schools/') }}" class="{{ $page == 'schools' ? 'active' : '' }}"><i class="fa fa-caret-left"></i> &nbsp;&nbsp;&nbsp;Schools</a></li>
		@endif

		@if ($page == 'classes')
			<li><a href="{{ url('/m/classes') }}" class="{{ $page == 'classes' ? 'active' : '' }}">Classes</a></li>
		@else
			<li><a href="{{ url('/m/schools/'.$school->id) }}" class="{{ $page == 'school' ? 'active' : '' }}">Classes</a></li>
		@endif

		<li><a href="{{ url('/m/students/'.$school->id) }}" class="{{ $page == 'students' ? 'active' : '' }}">Students</a></li>
		<li><a href="{{ url('/m/surveys/'.$school->id) }}" class="{{ $page == 'surveys' ? 'active' : '' }}">Surveys</a></li>
	</ul>
</div>