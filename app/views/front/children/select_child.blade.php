@extends('front.survey.layout')

@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
			<a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
				<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
					<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
					 
					 <div class="col-md-7" style="float: right;">
					<div class="logo child-selected"></div>
							<h1 class="logo">Child Selection</h1>

						</div>	

				</div>
			</div>

			<div class="survey-block survey-content page-signup">

				<div class="form-inner add-child-form">
		<div class="purchase-app-btn">
		<button class="btn btn-orange btn-lg">Purchase App </button>
</div>
					<div class="row col-md-11 select-child">
					 
<div id="Carousel">
		  <ul class="flip-items">
	    	<li>
	    		<img src="{{ url('public/front/img/add-child.png') }}" />

	    	</li>
	    	 	<li>
	    		<a href="{{URL::to('children/add')}}"><img src="{{ url('public/front/img/add-child.png') }}" /></a>
	    		
	    	</li>
	    	
		  </ul>
		</div>
							
					</div>

				</div>
			</div>

		</div>
	</div>
@stop
@section('script')

<script type="text/javascript">

	$( document ).ready(function(){ 


		$("#Carousel").flipster({
			itemContainer: 			'ul', // Container for the flippin' items.
			itemSelector: 			'li', // Selector for children of itemContainer to flip
			style:							'carousel', // Switch between 'coverflow' or 'carousel' display styles
			start: 							0, // Starting item. Set to 0 to start at the first, 'center' to start in the middle or the index of the item you want to start with.
			
			enableKeyboard: 		true, // Enable left/right arrow navigation
			enableMousewheel: 	true, // Enable scrollwheel navigation (up = left, down = right)
			enableTouch: 				true, // Enable swipe navigation for touch devices
			
			enableNav: 					false, // If true, flipster will insert an unordered list of the slides
			enableNavButtons: 	false, // If true, flipster will insert Previous / Next buttons
			
			onItemSwitch: 			function(){}, // Callback function when items are switches
		});



});
 

	</script>






@stop
@section('css')

{{HTML::style("public/front/css/main.css") }}
{{HTML::style("public/front/libs/flipster/src/css/jquery.flipster.css")}}

@stop


