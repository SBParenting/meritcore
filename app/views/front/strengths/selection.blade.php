@extends('front.survey.layout')

@section('content')

<div class="container-page">

	<div class="wrapper">
		<div class="parent-guide-block parent-guide-header col-md-12">
			<a href="{{URL::to('children/select')}}" class="logo col-md-1 sbp-logo"><img src="{{ url('public/front/img/logo-sbp.png') }}" /></a>
			<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
				<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
				<a href="#" class="logo"><div class=" parent-guide-thumbnail"></div><p class="child-name">Child name</p></a>
				<h1 class="strength-selection">STRENGTH SELECTION</h1>

				
			</div>
		</div>
			<div class="parent-guide-block parent-guide-content ">
			<div class="form-inner parent-reflect-inner">


			<div class="container-fluid map-container">

			<p class=" col-md-5 col-md-offset-2 map-text"><i class=" fa fa-circle"><span class="number-1">1</span> </i> have a look at OUR JOURNEY map of your child's strengths</p>

				<div class="col-md-7 col-md-offset-2 journey-map">
			
				<h1 class="col-md-6 col-md-offset-0">VISIT OUR JOURNEY MAP </h1>
				<div class="col-md-3 col-md-offset-2 pic-container">	<img class=" pull-right img-responsive " src="{{ url('public/front/img/map-icon.png') }}" /> </div>
		
				<p class="col-md-8 col-md-offset-0"> Check out Our Journey Map to see the two recomended focus areas to work on with your child. Click on <br>the strengths sections to reveal the scroes and information.</p>
				
				 </div>


			 </div>
				
			<div class="container-fluid selection-container">
			<p class=" col-md-5 col-md-offset-2 map-text"><i class=" fa fa-circle"><span class="number-2">2</span> </i>pick one of the two reccomended focus areas to work on with your child</p>

				<div class="row col-md-12"> 
					<div class="col-md-3 col-md-offset-3 family-communication">
					<h2>Family Communication </h2>
					<p >FAMILY SUPPORT &amp; EXPECTATIONS</p>
					<div class="family-icon"><img  src="{{ url('public/front/img/family-icon.png') }}" /> </div>
					<div class="strength-percent-1"><p class="text-center">36%</p> </div>
					<button class=" btn btn-lg btn-warning pull-right select-large"><span>SELECT</span> </button>
					 </div>



						<div class="col-md-3  school-culture">
						<h2>School Boundaries </h2>
					<p >SCHOOL CULTURE</p>
					<div class="school-icon"><img  src="{{ url('public/front/img/school-icon.png') }}" /> </div>
					<div class="strength-percent-2"><p class="text-center">42%</p> </div>
					<button class=" btn btn-lg btn-warning pull-right select-large"><span>SELECT</span> </button>
						 </div>

				</div>
				<div class="row">
							<p class=" col-md-5 col-md-offset-2 strength-text">or pick one of these alternate focus areas to work with your child</p>
							<div class="col-md-12">
								<div class=" col-md-2 col-md-offset-2 pick-strength">
									<div class="col-md-12 journey-text">
									<img class=" pull-left" src="{{ url('public/front/img/family-icon.png') }}" />
										<h4>Caring Family </h4>
									<p>FAMILY SUPPORT &amp; EXPECTATIONS</p>

									</div>
									<div class=" col-md-5 journey-percent"><p class="text-center">?</p> </div>
									<button class="btn btn-lg btn-warning select-small pull-right">SELECT </button>
								 </div>
								<div class=" col-md-2 pick-strength">
									<div class="col-md-12 journey-text">
									<img class=" pull-left" src="{{ url('public/front/img/family-icon.png') }}" />
										<h4>Adult Family Role Model </h4>
									<p>FAMILY SUPPORT &amp; EXPECTATIONS</p>

									</div>
									<div class=" col-md-5 journey-percent"><p class="text-center">?</p> </div>
									<button class="btn btn-lg btn-warning select-small pull-right">SELECT </button>
								 </div>
								<div class=" col-md-2 positive-peer">
									<div class="col-md-12 journey-text">
									<img class=" pull-left" src="{{ url('public/front/img/peer-icon.png') }}" />
										<h4>Positive Peer Relationships </h4>
									<p>PEER RELATIONSHIPS</p>

									</div>
									<div class=" col-md-5 journey-percent"><p class="text-center">?</p> </div>
									<button class="btn btn-lg btn-warning select-small pull-right">SELECT </button>
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
{{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}
{{ HTML::style("public/front/css/main.css") }}

@stop