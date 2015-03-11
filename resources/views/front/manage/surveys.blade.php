@extends('common.layout.front')

	@section('title')
		Surveys
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				@include('front.manage.partials.nav')

				<div class="col-md-12">

                    <h1>{{ $school->name }}</h1>

					<hr />

				</div>

			</div>

		</div>

	@stop

@stop