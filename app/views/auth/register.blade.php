@extends('auth.layout.base')

	@section('title')
		Login
	@stop

	@section('content')
		
		<div class="page-signin">

		    <div class="signin-header">
		        <div class="container text-center">
		            <a href="{{ url('/') }}">{{-- Logo goes here --}}</a>
		        </div>
		    </div>

		    <div class="signin-body">
		        <div class="container">
		        	<div class="form-container show-post-success closed">

		               	<h3>Your account was created successfully!</h3>
		        		<p>We sent an email verification message to your email address. In the meantime, you can continue to log in the site.</p>
		        		<p>
		        			<a href="{{ url('login') }}" class="btn btn-success">Log In</a>
		        		</p>

		        	</div>
		            <div class="form-container hide-post-success">

		               	<h3>Welcome to {{ \Config::get('site.title') }}</h3>
		        		<p>To create an account please enter your information below.</p>

		                {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off']) }}

		                	<!-- Tricking the browser so that login fields are not autofilled -->
		                	<input style="display:none">
							<input type="password" style="display:none">
		                    
		                    <fieldset>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-info-sign"></span>
		                                </span>
		                                {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-info-sign"></span>
		                                </span>
		                                {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-user"></span>
		                                </span>
		                                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-envelope"></span>
		                                </span>
		                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>

		                        <div class="form-group condensed">
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        
		                        <div class="form-group">
		                        	<br />
		                            <p class="text-muted text-small">By clicking on Sign up, you agree to <a href="javascript:;">terms & conditions</a> and <a href="javascript:;">privacy policy</a></p>
		                            <div class="divider"></div>
		                            <button type="submit" class="btn btn-success btn-lg btn-block">Sign up</button>
		                        </div>
		                    </fieldset>

		                {{ Form::close() }}

		                <section>
		                	<hr />
		                    <p class="text-center text-muted">Already have an account? <a href="{{ url('login') }}" >Log in now</a></p>
		                </section>
		                
		            </div>
		        </div>
		    </div>

		</div>
	@stop

