@extends('front.survey.layout')

@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
				<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
					<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
					<a href="#" class="logo"><div class="logo child-thumbnail"></div>
							<p class="child-name">Child name</p></a>
					<h1>ADD CHILD</h1>
				</div>
			</div>

			<div class="survey-block survey-content page-signup">
				<div class="form-inner add-child-form">
					<div class="signup-body"></div>
						<div class="container register-form">
					<!--		<div class="form-container show-post-success closed">

		               	<h3>Your account was created successfully!</h3>
		        		<p>We sent an email verification message to your email address. In the meantime, you can continue to log in the site.</p>
		        		<p>
		        			<a href="{{ url('login') }}" class="btn btn-success">Log In</a>
		        		</p>

		        	</div> -->
		        

							<div class="form-container hide-post-success" id="register-form-width">
								<div class="form-group form-head-text"><span class="line-thru">Fill in the information to get your child started </span></div>

									<section>
										 {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) }}
											
										<div class="form-group">
											<div class="input-group input-group-lg">
												
											<span class="input-group-addon">
											<span class=" glyphicon glyphicon-user"></span>

											 </span>
											  {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name*', 'autocomplete' => 'Off']) }}
											</div>

										</div>
												<div class="form-group">

											<div class="input-group input-group-lg">
												
											<span class="input-group-addon">
												<img src="/public/front/img/cake-icon.png" width="19px" height="20px">

											 </span>
											 <input type="text" class="form-control" id="cal" placeholder="Birth Date*">								 			
											 	</div>
											 	</div>

											 		
											 		<div class="radio-buttons">
											 	
											 		<dl class="dl-horizontal">
											 		<dd>
											<label class="ui-radio2">
											 <input type="radio"  id="female" name="radio1" value="option1">
											 <span ><label style="padding-left: 7px;">OR</label></span>
											 </label>
											

																					 
												<label class="ui-radio">
											 <input type="radio" id="male" name="radio1" value="option2">
											       <span></span>
											 	</label>
											 	<span id="calculate-age">?</span><span class="text">years old</span>
											 	</dd>
											 	
											 	</dl>

											 	</div>
											 	<div class="form-group">
											<div class="input-group input-group-lg">
												
											<span class="input-group-addon">
											<span class=" glyphicon glyphicon-lock"></span>

											 </span>
											  {{ Form::text('student_ID', null, ['class' => 'form-control id-input', 'placeholder' => 'Student ID', 'autocomplete' => 'Off']) }}
											  <p class="id-text"><a href="#">What is this for?</a></p>
											</div>

										</div>
										<p font-size="14pt;">* Required Fields</p>
											 
										<div class="form-group"> 
										
										<button type="submit" class="btn btn-lg btn-block btn-orange">Sign up</button>

										</div>


										

								
									</section>
									{{ Form::close() }}	
									<div id="dropzone">
									<form action="/file-upload" class="dropzone" id="change-avatar">
										<div class="dz-message" style="color: black;"></div>
									</form>
									</div>
 									</div>

						
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

<script type="text/javascript">

$('#cal').datepicker().on('change', function(e) { 

	var currentDate = new Date(); 
	var selectedDate = new Date($(this).val()); 
	var age = currentDate.getFullYear() - selectedDate.getFullYear(); 
	var m = currentDate.getMonth() - selectedDate.getMonth(); 
	if (m < 0 || (m === 0 && currentDate.getDate() < selectedDate.getDate())) { 
		age--; 
	} 
	$('#calculate-age').html(age); });;



</script>
@stop



