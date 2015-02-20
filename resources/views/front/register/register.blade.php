@extends('common.layout.front')

	@section('title')
		Register
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

		               	<h2>Please verify your email address.</h2>
		               	<hr />
		        		<p>To continue with creating your account, please click on the link in the verification message that we sent to your email address.</p>

		        		<section>
		                	<hr />
		                    <p class="text-muted">Did not recieve an email? &nbsp;&nbsp;<a href="{!! url('register/resend/') !!}" class="js-post" >Resend my verification email.</a></p>
		                </section>
		        	</div>
		            <div class="form-container hide-post-success text-center">

		        		<p>To create an account please enter your information below.<br /><br /></p>

		                {!! Form::open(['role' => 'form', 'novalidate', 'class' => 'submit-on-enter']) !!}

		                	<!-- Tricking the browser so that login fields are not autofilled -->
		                	<input style="display:none">
							<input type="password" style="display:none">

		                    <fieldset>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-info-sign"></span>
		                                </span>
		                                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-info-sign"></span>
		                                </span>
		                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-envelope"></span>
		                                </span>
		                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
		                            </div>
		                        </div>

		                        <div class="form-group condensed">
		                            <div class="input-group js-dropdown-select">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-cog"></span>
		                                </span>
		                                {!! Form::text('registration_code', null, ['class' => 'form-control', 'placeholder' => 'Registration Code']) !!}
		                            </div>
		                        </div>

		                        <hr />

		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'Off']) !!}
		                            </div>
		                        </div>

		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password', 'autocomplete' => 'Off']) !!}
		                            </div>
		                        </div>

		                        <div class="form-group">
		                        	<br />
		                            <p class="text-muted text-small">By clicking on Sign up, you agree to <a href="#">terms & conditions</a> and <a href="#">privacy policy</a></p>
		                            <div class="divider"></div>
		                            <button type="submit" class="btn btn-warning btn-lg btn-block loader-inside">Sign up</button>
		                        </div>
		                    </fieldset>

		                {!! Form::close() !!}

		                <section>
		                	<hr />
		                    <p class="text-center text-muted">Already have an account? <a href="{!! url('login') !!}" >Log in now</a></p>
		                </section>

		            </div>
		        </div>
		    </div>

		</div>
	@stop

