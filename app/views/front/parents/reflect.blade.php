@extends('front.survey.layout')

@section('content')

<div class="container-page">

	<div class="wrapper">
		<div class="parent-guide-block parent-guide-header row">
			<a href="{{URL::to('children/select')}}" class="logo col-md-1"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
			<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
				<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>



				<a href="#" class="logo"><div class=" parent-guide-thumbnail"></div><p class="child-name">Child name</p></a>
				<h1 class="parent-guide header-content">PARENT GUIDE</h1>

				<div id="header-content" >

				<div class="track">
				<p class="col-md-8 pull-right">Family Communication <span>FAMILY SUPPORT &amp; EXPECTATIONS</span></p>
				</div>

				<div class="col-md-2">
				<div class="track-percent"><span class="percent"><p>50%</p></span></div>
				
				</div>
				</div>
			</div>
		</div>

		<div class="parent-guide-block parent-guide-content ">
			<div class="form-inner parent-reflect-inner">
<div id="parent-guide-nav" class="col-md-12 collapse navbar-collapse">

					<ul class="nav"> 
						<li class="nav-item"><a><img src="{{ url('public/front/img/empower-icon.png')}}" height="32px" width="32px" />EMPOWER</a></li>
						<li class="nav-item border"><a href="{{URL::to('parents/explore')}}"><img src="{{ url('public/front/img/build-icon.png')}}" height="32px" width="32px" />BUILD</a></li>
						<li class="nav-item"><a href="{{URL::to('parents/explore')}}"><img src="{{ url('public/front/img/explore-icon.png')}}" height="32px" width="32px" />EXPLORE</a></li>
						<li class="nav-item border "><a class="selected-item" href="{{URL::to('parents/reflect')}}"><img src="{{ url('public/front/img/reflect-icon.png')}}" height="32px" width="32px" />REFLECT</a></li>
					</ul>
				</div>
				<div class=" container-fluid first-step">
					<p class="col-md-12 col-md-offset-1"><strong>First:</strong><span> Reflect on the question below</span></p>
					</div>
			<div class="container-fluid questions-container"> 
			
					
				<div class="col-md-12 col-md-offset-1 question-display">
					<div class=" circle pull-left"><span class="question-number">3</span> 
							<p class="question-amount">3 out of 11 </p>

					</div>
					<p class="col-md-6 col-md-offset-1 question text-center">What could I do more or less of, or stop doing to be more consistent in the way I communicate with my child - how can it be deepend?</p>
					 </div>



			</div>

					<div class="container-fluid"> 
							<label class="pull-left second-label" ><span>Second: </span>Click on what statement reflects you the best </label>
								<label class="pull-right third-label"><span>Third:</span> Input your thoughts and reflections </label>
					</div>
					 <div class="container-fluid">

					 <div class="col-md-12 user-input"> 

					
					 <div class="col-md-4 col-md-offset-1 answer-selection" > 


					 <ul class=" col-md-12 answer-list"> 
					 <li class=" odd"><a>I feel like i can make an honest effot to organize my family time better</a> </li>
					 <li class="even"><a>I'm doing all that I can to help with the communication with my children</a></li>
					 <li class="odd"><a>I can be less negative when I speak with my child use a postive output</a></li>

					 </ul>


					 </div>

					 	
					 <div class="col-md-4 col-md-offset-1 user-feedback" >

				
										 		<div class="mic-button col-md-2 "><img src="{{ url('public/front/img/mic-icon.png')}}" class="img-responsive"> </div>

					 		<textarea> </textarea>
					  </div>


					 </div>


					  </div>
					  		<div class="container-fluid btns-container">
				<a href="#" class="pull-right btn btn-lg btn-warning btn-next"><i class="glyphicon glyphicon-arrow-right"></i> Next Reflection </a>	
				<a href="#" class="pull-left btn btn-lg btn-primary btn-back "><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
				</div>	

			
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