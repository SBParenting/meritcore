
<div class="col-md-12">
	<ul class="top-nav">
		@if ($is_admin)
			<li><a href="{{ url('/m/schools') }}" class="{{ $page == 'schools' ? 'active' : '' }}">Schools</a></li>
		@endif

		@if (($is_admin && $page == 'classes') || !$is_admin)
			<li><a href="{{ url('/m/classes') }}" class="{{ $page == 'classes' ? 'active' : '' }}">Classes</a></li>
		@endif

		<li><a href="{{ url('/m/students') }}" class="{{ $page == 'students' ? 'active' : '' }}">Students</a></li>
		<li><a href="{{ url('/m/surveys') }}" class="{{ $page == 'surveys' ? 'active' : '' }}">Surveys</a></li>
	</ul>
</div>