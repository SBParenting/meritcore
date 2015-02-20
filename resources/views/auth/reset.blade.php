@extends('common.layout.front')
	
	@section('title')
		Reset Password
	@stop

	@section('content')
		
		<div class="page-signin">

		    <div class="signin-header">
		        <div class="container text-center">
		            <a href="{!! url('/login') !!}"><img src="{!! url('public/front/img/mc-logo.png') !!}" /></a>
		        </div>
		    </div>

		    <div class="signin-body">
		        <div class="container">
		            <div class="form-container">

		                <h3>Reset Your Password</h3>
				        
				        <p>Please enter a new password below.</p>
		       
				        {!! Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) !!}

				        {!! Form::hidden('token', $token) !!}

				        	<fieldset>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-envelope"></span>
		                                </span>
		                                {!! Form::text('email', null, ['class' => 'form-control', 'data-name' => 'email', 'placeholder' => 'Email Address']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {!! Form::password('password', ['class' => 'form-control', 'data-name' => 'password', 'placeholder' => 'Password']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'data-name' => 'password_confirmation', 'placeholder' => 'Password Confirmation']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                        	 <button type="submit" class="btn btn-warning btn-lg pull-right">Reset Password</button>
		                        </div>
		                    </fieldset>
			       	
				       	{!! Form::close() !!}

				       	<section>
				       		<hr />
		                    <p class="text-left"><a href="{!! URL::to('login') !!}">&larr; Back to login</a></p>
		                </section>
	                
		            </div>
		        </div>
		    </div>

		</div>
	@stop

