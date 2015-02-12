@extends('auth.layout.base')

	@section('title')
		Login
	@stop

	@section('content')

		<div class="page-signin">

		    <div class="signin-header">
		        <div class="container text-center">
		            <a href="{!! url('/login') !!}"><img src="{!! url('public/front/img/mc-logo.png') !!}" width="200" /></a>
		        </div>
		    </div>

		    <div class="signin-body">
		        <div class="container">
		        	<div class="form-container show-post-success closed">

		               	<h3>Thank you for signing up!</h3>
		        		<p>To continue with creating your account, please verify your email address by clicking the link in the verification message we sent.</p>
		        	</div>
		            <div class="form-container hide-post-success text-center">

		            	<h2>Thank you for verifying your email address.</h2>

		                {!! Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) !!}

		                    <fieldset>

		                    	<p><br />To finalize your account, please select your school from the list.<br /></p>
		                        <div class="form-group condensed">
		                            <div class="input-group js-dropdown-select">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-home"></span>
		                                </span>
		                                {!! Form::dropdown('role', \App\Models\Role::$public, null, ['class' => 'form-control', 'placeholder' => 'What is your role?'], 'btn btn-default') !!}
		                            </div>
		                        </div>

		                        <p><br />If you cannot find your school in the list, please enter the full name of school<br /></p>
		                        <div class="form-group condensed">
		                            <div class="input-group js-dropdown-select">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-home"></span>
		                                </span>
		                                {!! Form::dropdown('role', \App\Models\Role::$public, null, ['class' => 'form-control', 'placeholder' => 'What is your role?'], 'btn btn-default') !!}
		                            </div>
		                        </div>

		                        <div class="form-group">
		                        	<br />
		                            <div class="divider"></div>
		                            <button type="submit" class="btn btn-warning btn-lg btn-block">Finalize</button>
		                        </div>
		                    </fieldset>

		                {!! Form::close() !!}

		            </div>
		        </div>
		    </div>

		</div>
	@stop

