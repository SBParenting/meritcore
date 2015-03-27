@extends('admin.layout.page')

	@section('title')
	    Manage Schools
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Schools</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2"><span class="size-h2">{{ $record->name }}</span></span>
			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/schools') }}" class="btn btn-default btn-lg"><i class="fa fa-arrow-left"></i> Back to Schools</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="row">

			<div class="col-lg-12">

				<ul class="nav nav-tabs">
				  <li class="{{ $section == 'overview' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/info/$record->id") }}">Overview</a></li>
				  <li class="{{ $section == 'classes' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/info-classes/$record->id") }}">Classes</a></li>
				  <li class="{{ $section == 'students' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/info-students/$record->id") }}">Students</a></li>
				  <li class="{{ $section == 'surveys' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/info-surveys/$record->id") }}">Surveys</a></li>
				  <li class="{{ $section == 'users' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/info-users/$record->id") }}">Teachers &amp; Personnel</a></li>
				  @if ($section=='addclass')
				  	<li class="{{ $section == 'addclass' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/add-class/$record->id") }}">Add Class</a></li>
				  @endif
				  @if ($section=='addstudent')
				  	<li class="{{ $section == 'addstudent' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/add-student/$record->id") }}">Add Student</a></li>
				  @endif
				  @if ($section=='addsurvey')
				  	<li class="{{ $section == 'addsurvey' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/add-survey/$record->id") }}">Add Survey</a></li>
				  @endif
				  @if ($section=='adduser')
				  	<li class="{{ $section == 'adduser' ? 'active' : '' }}"><a href="{{ url("/admin/s/schools/add-user/$record->id") }}">Add Teacher/Personnel</a></li>
				  @endif
				</ul>

				@include("admin.schools.schools.sections.$section")


				<div class="clearfix"></div>

				<hr />

				<a href="{{ url('/admin/s/schools') }}" class="btn btn-default btn-lg close-button">Done</a>

			</div>

		</div>

	@stop

@stop