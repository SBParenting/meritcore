@extends('common.layout.front')

	@section('title')
		Login
	@stop

	@section('content')
		
		<div class="page-signin">

		    <div class="signin-header">
		        <div class="container text-center">
		            <a href="{{ url('/login') }}"><img src="{{ url('public/front/img/mc-logo.png') }}" /></a>
		        </div>
		    </div>

		    <div class="signin-body">
		        <div class="container">
		            <div class="form-container">

		               	<h3>Welcome to {{ \Config::get('site.title') }}</h3>
		        		<p>To sign in please enter your account information below.</p>

		                {!! Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) !!}
		                    
		                    <fieldset>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-envelope"></span>
		                                </span>
		                                {!! Form::text('email', null, ['class' => 'form-control', 'data-name' => 'email', 'placeholder' => 'Email address', 'autocomplete' => 'Off']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {!! Form::password('password', ['class' => 'form-control', 'data-name' => 'password', 'placeholder' => 'Password', 'autocomplete' => 'Off']) !!}
		                            </div>
		                        </div>
		                        <div class="form-group text-right">
		                            <input name="remember" type="checkbox" class="i-checks js-select" value="1"> Remember Me
		                        </div>

		                        <div class="form-group">
		                        	 <button type="submit" class="btn btn-warning btn-lg btn-block">Login</button>
		                        </div>
		                    </fieldset>

		                {!! Form::close() !!}

		                <section>
		                	<hr />
		                    <p class="text-center"><a href="{{ url('password/remind') }}">Forgot your password?</a></p>
		                </section>
		                
		            </div>
		        </div>
		    </div>

		</div>
	@stop

