@extends('front.survey.layout')

@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
				<div class="container">
					<a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
					<h1 style="text-align: center; color: #666;" >SIGN UP</h1>
				</div>
			</div>

			<div class="survey-block survey-content page-signup">
				<div class="form-inner form-bg">
					<div class="signup-body"></div>
						<div class="container register-form">
					<div class="form-container show-post-success closed" style="display:none">

		               	<h3>Your account was created successfully!</h3>
		        		<p>We sent an email verification message to your email address. In the meantime, you can continue to log in the site.</p>
		        		<p>
		        			<a href="{{ url('login') }}" class="btn btn-success">Log In</a>
		        		</p>
		        	</div>
							<div class="form-container hide-post-success" id="register-form-width">
								   <span class="line-thru2">Fill in all the information to get you family started</span>

									<section>
										 {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) }}
											
										<div class="form-group">
											<div class="input-group input-group-lg">
												
											<span class="input-group-addon">
											<span class=" glyphicon glyphicon-envelope"></span>

											 </span>
											  {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'autocomplete' => 'Off']) }}
											</div>

										</div>
												<div class="form-group">
											<div class="input-group input-group-lg">
												
											<span class="input-group-addon">
											<span class=" glyphicon glyphicon-lock"></span>

											 </span>
											 	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'Off']) }}
											</div>

										</div>
										<br/>
										<div class="form-group"> 
										<p class="text-muted text-medium">

										By clicking on Sign up, you agree to 
										<a href="javascript:;">terms &amp; conditions</a>
										and
										<a href="javascript:;">privacy policy</a>
										 </p>
										 <div class="divider"></div>
										<button type="submit" class="btn btn-lg btn-block btn-orange">Sign Up</button>

										</div>


										

								
									</section>
									{{ Form::close() }}	
									<section>
										<p class="text-center text-muted"> 

											Already have an account? <a href="{{URL::to('login')}}">Log in now</a>

										</p>
								</section>

							
							</div>

						<div class="cycling-logos hide-post-success">Cycling logos </div>
						</div>			

				</div>
			</div>

		</div>
	</div>
@stop

@section('css')

{{ HTML::style("public/front/css/main.css") }}

@stop

@section('script')

{{ HTML::script("public/admin/libs/jquery-form/jquery.form.min.js") }}

{{ HTML::script("public/admin/js/api.js") }}
{{ HTML::script("public/admin/js/app.js") }}
{{ HTML::script("public/admin/js/form.js") }}

@stop