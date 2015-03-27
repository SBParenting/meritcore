@extends('admin.layout.page')

	@section('title')
	    Manage School Boards
	@stop

	@section('page-content')

		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li>
						<a href="{{ url('admin/dashboard') }}">Home</a>
					</li>
					<li class="active">
						<strong>Manage School Boards</strong>
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span class="size-h2"><span class="size-h2">{{ $record->name }}</span></span>
			</div>
			<div class="col-md-6 text-right">
				<a href="{{ url('/admin/s/boards') }}" class="btn btn-default btn-lg"><i class="fa fa-arrow-left"></i> Back to School Boards</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><hr /></div>
		</div>

		<div class="row">

			<div class="col-lg-12">

				<ul class="nav nav-tabs">
				  <li class="{{ $section == 'overview' ? 'active' : '' }}"><a href="{{ url("/admin/s/boards/info/$record->id") }}">Overview</a></li>
				  <li class="{{ $section == 'schools' ? 'active' : '' }}"><a href="{{ url("/admin/s/boards/info-schools/$record->id") }}">Schools</a></li>
				  <li class="{{ $section == 'users' ? 'active' : '' }}"><a href="{{ url("/admin/s/boards/info-users/$record->id") }}">Administrators</a></li>
				  @if ($section=='addschool')
				  	<li class="{{ $section == 'addschool' ? 'active' : '' }}"><a href="{{ url("/admin/s/boards/add-school/$record->id") }}">Add School</a></li>
				  @endif
				  @if ($section=='adduser')
				  	<li class="{{ $section == 'adduser' ? 'active' : '' }}"><a href="{{ url("/admin/s/boards/add-user/$record->id") }}">Add Administrator</a></li>
				  @endif
				</ul>

				@include("admin.schools.boards.sections.$section")

				<div class="clearfix"></div>

				<hr />

				<a href="{{ url('/admin/s/boards') }}" class="btn btn-default btn-lg close-button">Done</a>

			</div>

		</div>

	@stop

@stop