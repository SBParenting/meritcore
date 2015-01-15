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
		            <div class="form-container">

		               	<h3>Welcome to {{ \Config::get('site.title') }}</h3>
		        		<p>To sign in please enter your account information below.</p>

		                {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off']) }}
		                    
		                    <fieldset>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-envelope"></span>
		                                </span>
		                                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-lock"></span>
		                                </span>
		                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'Off']) }}
		                            </div>
		                        </div>
		                        <div class="form-group text-right">
		                            <input name="remember" type="checkbox" class="i-checks js-select" value="1"> Remember Me
		                        </div>

		                        <div class="form-group">
		                        	 <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
		                        </div>
		                    </fieldset>

		                {{ Form::close() }}

		                <section>
		                	<hr />
		                    <p class="text-center"><a href="{{ URL::to('password/remind') }}">Forgot your password?</a></p>
		                    <p class="text-center text-muted text-small">Don't have an account yet? <a href="{{ url('register') }}">Sign up</a></p>
		                </section>
		                
		            </div>
		        </div>
		    </div>

		</div>
	@stop

