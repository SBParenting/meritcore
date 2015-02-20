@extends('common.layout.front')

	@section('title')
		Schools
	@stop

	@section('content')

		<div class="page-manage">

			@include('front.manage.partials.header')

			<div class="container">

				@include('front.manage.partials.nav')

				@foreach ($schools as $school)

					<div class="col-md-12">

	                    <h1><a href="{{ url('m/schools/'.$school->id) }}">{{ $school->name }}</a></h1>

						<hr />

					</div>

					<?php $count = 0; ?>

					@foreach ($classes as $class)

						@if ($class->school_id == $school->id)

							<?php $count++; ?>

							@include('front.manage.items.classroom')

						@endif

					@endforeach

					@if ($count > 0)

						@include('front.manage.items.classroom_add')

					@else

						@include('front.manage.items.classroom_none')

					@endif

					<div class="col-md-12">
						<hr />
					</div>

				@endforeach

			</div>

		</div>

	@stop

@stop