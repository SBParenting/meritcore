@extends('admin.layout.page')

	@section('title')
	    Manage Classes
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage Classes</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2"><span class="size-h2">{{ $record->school->name }}&nbsp;&nbsp;<i class="fa fa-caret-right"></i>&nbsp;&nbsp;{{ $record->title }}</span></span>
			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/classes') }}" class="btn btn-default btn-lg"><i class="fa fa-arrow-left"></i> Back to Classes</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="row">

			<div class="col-lg-12">

				<ul class="nav nav-tabs">
					<li class="{{ $section == 'overview' ? 'active' : '' }}"><a href="{{ url("/admin/s/classes/info/$record->id") }}">Overview</a></li>
					<li class="{{ $section == 'students' ? 'active' : '' }}"><a href="{{ url("/admin/s/classes/info-students/$record->id") }}">Students</a></li>
					<li class="{{ $section == 'surveys' ? 'active' : '' }}"><a href="{{ url("/admin/s/classes/info-surveys/$record->id") }}">Surveys</a></li>
				</ul>

				@include("admin.schools.classes.sections.$section")

				<a href="{{ url('/admin/s/classes') }}" class="btn btn-default btn-lg close-button">Done</a>

			</div>

		</div>

	@stop

@stop