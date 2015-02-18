@extends('front.survey.layout')

@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
				<div class="container">
					<a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
					<h1 style="text-align: center; color: #666;" >Reset Password</h1>
				</div>
			</div>

			<div class="survey-block survey-content page-signup">
				<div class="form-inner form-bg">
					<div class="signup-body"></div>
                    <div class="container register-form">
	    				<div class="form-container show-post-success closed" style="display: none;">

		                   	<h3>Your password has been reset!</h3>
		            		<p>We sent an email with the next steps to change your password. If you didn't receive the message, please, click on the button below.</p>
		            		<p><a href="{{ url('remind') }}" class="btn btn-success">Try Again</a></p>
		        	    </div>
		        

                        <div class="form-container hide-post-success" id="register-form-width">
                            <h3 style="color: #666;">Forgot password?</h3>
				        
				            <p style="color: #666;">Not a problem! Just enter your email address below and we will send a reset link.</p>
		       
				            {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) }}

				        	<fieldset>
		                        <div class="form-group">
		                            <div class="input-group input-group-lg">
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-envelope"></span>
		                                </span>
		                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
		                            </div>
		                        </div>
		                        <div class="form-group">
		                        	 <button type="submit" class="btn btn-orange btn-lg pull-right">Reset Password</button>
		                        </div>
		                    </fieldset>
			       	
				       	    {{ Form::close() }}

				       	    <section>
				       		    <hr />
		                        <p class="text-left"><a href="{{ URL::to('login') }}">&larr; Back to login</a></p>
		                    </section>


                            {{ Form::close() }}
					

							
                        </div>

						<div class="cycling-logos hide-post-success">Cycling logos </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')

	{{ HTML::script("public/admin/libs/jquery-form/jquery.form.min.js") }}

{{ HTML::script("public/admin/js/api.js") }}
{{ HTML::script("public/admin/js/app.js") }}
{{ HTML::script("public/admin/js/form.js") }}

@stop

@section('css')

{{ HTML::style("public/front/css/main.css") }}

@stop