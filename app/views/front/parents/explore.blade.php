@extends('front.survey.layout')

@section('content')

<div class="container-page">

	<div class="wrapper">
		<div class="parent-guide-block parent-guide-header ">
			<a href="{{URL::to('children/select')}}" class="logo col-md-1 sbp-logo"><img src="{{ url('public/front/img/logo-sbp.png') }}" /></a>
			<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
				<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
				<a href="#" class="logo"><div class=" parent-guide-thumbnail"></div><p class="child-name">Child name</p></a>
				<h1 class="parent-guide">PARENT GUIDE</h1>

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

				<div id="parent-guide-nav" class="col-md-10 container-fluid">
					<ul class="nav"> 
						<li class="nav-item"><a><img src="{{ url('public/front/img/empower-icon.png')}}" height="32px" width="32px" />EMPOWER</a></li>
						<li class="nav-item border"><a href="{{URL::to('parents/explore')}}"class="selected-item-3"><img src="{{ url('public/front/img/build-icon.png')}}" height="32px" width="32px" />BUILD</a></li>
						<li class="nav-item"><a href="{{URL::to('parents/explore')}}" class="selected-item-2"><img  src="{{ url('public/front/img/explore-icon.png')}}" height="32px" width="32px" />EXPLORE</a></li>
						<li class="nav-item border "><a class="" href="{{URL::to('parents/reflect')}}"><img src="{{ url('public/front/img/reflect-icon.png')}}" height="32px" width="32px" />REFLECT</a></li>
					</ul>
				</div>
					<div class="explore-build-content container-fluid">
					
					<div class="explore-container container-fluid" class="col-md-11">
						<div class="explore-inner col-md-9 col-md-offset-2"> 
						<span class="title-text-exp ">EXPLORE </span>
						`<div class="col-md-5 pick-question-exp">
						<div class="exp-text">
							<p class="text-center">?</p>
							<p class="text-center">CLICK</p>
							<p class="text-center">to pick a question to explore</p>
							</div>
						 </div>

							<div class="col-md-5 remind-question-exp"> 
							<div class="remind-text">
							<p class="text-center">What do you like most about the way we talk to each other?</p>
							<p class="text-center">REMIND ME TO EXPLORE </p>
							</div>
							</div>

						</div>

				 </div>
				 	<div class="build-container container-fluid" class="col-md-11">
						<div class="build-inner col-md-9 col-md-offset-2"> 
						<span class="title-text-build ">BUILD</span>
						`<div class="col-md-5 pick-strategy">
								<div class="pick-text">
							<p class="text-center">Make It a Ritual:</p>
							<br>
							<div class="rate-container">
							<p class="text-center">rate how it worked for you </p>
							<input class="rating "> 
							<p class="text-center">PICK NEXT STRATEGY </p>
							</div>
							</div>
						 </div>

						 	<div class="col-md-5 view-strategy"> 
									<div class="build-text">
							<p class="text-center">?</p>
							<p class="text-center">CLICK</p>
							<p class="text-center">to pick a strategy to build</p>
							</div>

							</div>

		
		
						</div>

				 </div>

					<div class="container-fluid btns-container">
				<a href="#" class="pull-right btn btn-lg btn-warning next-btn"><i class="glyphicon glyphicon-arrow-right"></i> Next </a>	
				<a href="#" class="pull-left btn btn-lg btn-primary back-btn"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
				</div>	
			
				</div>
	
		




		</div>
	</div>
</div>
</div>
@stop
@section('script')
{{HTML::script("public/front/libs/bootstrap-star/js/star-rating.js")}}
	<script> 
	$(".rating").rating(['min'=>1, 'max'=>10, 'step'=>2, 'size'=>'lg' , 'showCaption'=>false]);

	</script>
@stop

@section('css')
{{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}
{{ HTML::style("public/front/css/main.css") }}

@stop