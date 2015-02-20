@extends('common.layout.front')

	@section('title')
		Confirm Your Student Details
	@stop

	@section('content')

		<div class="page-signin">

		    <div class="signin-header">
		        <div class="container text-center">
		            <a href="{{ url('/') }}/{{$key}}"><img src="{{ url('public/front/img/mc-logo.png') }}" /></a>
		        </div>
		    </div>

		    <div class="signin-body">
		        <div class="container">
		            <div class="form-container text-center">

		               	<h1>Yay.</h1>
		        		<p>You have successfully completed the student survey. Thank you for your participation.</p>
		        		<hr />
		            </div>
		        </div>
		    </div>

		</div>
	@stop

