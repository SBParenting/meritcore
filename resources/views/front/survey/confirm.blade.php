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
		            <div class="form-container">

		               	<h3>Welcome to Heroes Student Survey</h3>
		        		<p>To start the survey, please confirm your Name and Student ID.</p>
		        		<hr />

		                {!! Form::open(['url' => url("$key/confirm"), 'role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) !!}

		                    <fieldset>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-user" style="line-height: 17px;"></span>
		                                </span>
		                                {!! Form::text('name', null, ['class' => 'form-control', 'data-name' => 'name', 'placeholder' => 'Full Name', 'autocomplete' => 'Off']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock" style="line-height: 17px;"></span>
		                                </span>
		                                {!! Form::text('sid', null, ['class' => 'form-control', 'data-name' => 'sid', 'placeholder' => 'Student ID', 'autocomplete' => 'Off']) !!}
		                            </div>
		                        </div>

		                        <hr />

		                        <div class="form-group">
		                        	 <button type="submit" class="btn btn-warning btn-lg btn-block">Start Survey <i class="fa fa-arrow-right"></i></button>
		                        </div>
		                    </fieldset>

		                {!! Form::close() !!}

		            </div>
		        </div>
		    </div>

		</div>
	@stop

