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
						<li class="nav-item"><a class="empower-selected" ><img src="{{ url('public/front/img/empower-icon.png')}}" height="32px" width="32px" />EMPOWER</a></li>
						<li class="nav-item border"><a href="{{URL::to('parents/explore')}}"><img src="{{ url('public/front/img/build-icon.png')}}" height="32px" width="32px" />BUILD</a></li>
						<li class="nav-item"><a href="{{URL::to('parents/explore')}}"><img src="{{ url('public/front/img/explore-icon.png')}}" height="32px" width="32px" />EXPLORE</a></li>
						<li class="nav-item border "><a href="{{URL::to('parents/reflect')}}"><img src="{{ url('public/front/img/reflect-icon.png')}}" height="32px" width="32px" />REFLECT</a></li>
					</ul>
				</div>
			

					<div class="container-fluid section-top">
						<div class=" col-md-8 dark-green col-md-offset-6">
						<p> move the slider for each indicator to what is true or not for your child</p>
						 </div>
					 </div>
					 <div class="container-fluid light-green"> </div>
					 <div class="container-fluid grey"><img class=" not-true "src="{{ url('public/front/img/not-true.png')}}" /> <img class=" true" src="{{ url('public/front/img/true.png')}}" /></div>

						 <div class="container-fluid slider-table"> 
						 	<table >
						 		<tr class="tr-odd">
						 		<td class=" number-column"><div class=" circle-green"><span class="empower-number">1</span>  </div> </td>
						 		<td class=" question-column">Does your child seem to be more emotionally and socially connected? Is your child showing increased maturity in his or her social and emotional relationships (compassion, supporting, contributing to long-term relationships reconizing others)? </td>
						 		<td class="slider-column">
						 		<div class="slider">
									<div>
										<img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px">
										<img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px">
									</div>
								</div> 
								</td>
						 		 </tr>
						 		 	<tr class="tr-even">
						 		<td class=" number-column"><div class=" circle-green"><span class="empower-number">2</span>  </div> </td>
						 		<td class=" question-column text-odd">My child likes to tell me what's on his or her mind. </td>
						 		<td class="slider-column">
						 		<div class="slider">
									<div>
										<img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px">
										<img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px">
									</div>
								</div> 
								</td>
						 		 </tr>
						 		  		 	<tr class="tr-odd">
						 		<td class=" number-column"><div class=" circle-green"><span class="empower-number">3</span>  </div> </td>
						 		<td class=" question-column ">My child feels respected and comfortable with telling me about things that are important to him/her.</td>
						 		<td class="slider-column">
						 		<div class="slider">
									<div>
										<img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px">
										<img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px">
									</div>
								</div> 
								</td>
						 		 </tr>
						 		 	 		  		 	<tr class="tr-even">
						 		<td class=" number-column"><div class=" circle-green"><span class="empower-number">4</span>  </div> </td>
						 		<td class=" question-column text-odd">My child is willing to admit when he or she doesnt know something. </td>
						 		<td class="slider-column">
						 		<div class="slider">
									<div>
										<img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px">
										<img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px">
									</div>
								</div> 
								</td>
						 		 </tr>
						 		 	 		  		 	<tr class="tr-odd">
						 		<td class=" number-column"><div class=" circle-green"><span class="empower-number">5</span>  </div> </td>
						 		<td class=" question-column">My child is willing to tell me when he or she doesnt agree or like something. </td>
						 		<td class="slider-column">
						 		<div class="slider">
									<div>
										<img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px">
										<img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px">
									</div>
								</div> 
								</td>
						 		 </tr>
						 	 </table>

						 	 	  		<div class="container-fluid btns-container">
				<a href="#" class="pull-right btn btn-lg btn-warning empower-next"><i class="glyphicon glyphicon-arrow-right"></i> Next  </a>	
				<a href="#" class="pull-left btn btn-lg btn-primary empower-back" ><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
				</div>	



						 </div>


			</div>
			</div>
			
			</div>
	
		</div>

	</div>
</div>
@stop
@section('script')

<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>


<script>

    $(".slider").slider({
        orientation: "horizontal",
        range: "min",
        min: 0,
      	max: 100,
        value: 50,
       step: 1 ,
        animate: true,
        slide:  function(e){
        		
        	$(this).find('.ui-slider-handle').css({
        		"background": " url('/public/front/img/white-circle.png')",
        		"text-align": "center",
        		padding: '12px 30px 35px 13px', 
        		top: "-22px"

        	});

			$('.question-strength , .answers').find('.list-item').css({'background-color': 'transparent'}).find('a').css({"color": '#777777'});

			var color = $(this).parents('.survey-row').css('background-color');

        	$.each($('.slider'),function(){

        		var position = $(this).slider("option", "value");
        		if ($(this).find('.ui-slider-handle').css('background-image') == "url(http://meritcore.local/public/front/img/white-circle.png)") {
        	
	        		if (position >= 0 && position <= 20) {
	        			$('#strongly-agree, #not-at-all').css({"background-color": color}).find('a').css({"color": '#ffffff'});
	        			$(this).find('.ui-slider-handle').html(position);
	        		}

	        		if (position >= 20 && position <= 40) {
	        			$('#agree , #not-so-much').css({"background-color": color}).find('a').css({"color": '#ffffff'});
	        			$(this).find('.ui-slider-handle').html(position);
	        		}
        			if (position >= 40 && position <= 60) {
	        			$('#not-sure').css({"background-color": color }).find('a').css({"color": '#ffffff'});
	        			$(this).find('.ui-slider-handle').html(position);
	        		}
	        	
    				if (position >= 60 && position <= 80) {
	        			$('#disagree , #somewhat-concern').css({"background-color": color }).find('a').css({"color": '#ffffff'});
	        			$(this).find('.ui-slider-handle').html(position);
	        		}
					if (position >= 80 && position <= 100) {
	        			$('#strongly-disagree , #major-concern ').css({"background-color": color }).find('a').css({"color": '#ffffff'});
	        			$(this).find('.ui-slider-handle').html(position);
	        		}
        			
        		}


        	});
        },

       change: function(){

        	


        }


        
    });

$('.ui-slider-horizontal').height(3);



$('.ui-slider-horizontal .ui-slider-handle').css({
	borderRadius: "80px" ,
	top: "-28px",
	opacity: '4',
	border: "none",
	padding: "28px" ,
	"z-index": '4',
	"background": "url('/public/front/img/default-circle.png') ",
	"background-position": "center",

});

$('.slider .ui-slider-range').css({

	'background': "#bfbfbf"

});
$('.ui-widget-content').css({
'background':  "#fdb535"

});




var sliderPosition = $('.slider') , initialValue = 50;

var updateSliderValue = function (e , ui){

	var slider = $(this).data().slider;
slider.element.find(".ui-slider-handle").text(slider.value());
};



</script>
@stop

@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
{{ HTML::style("public/front/css/main.css") }}

@stop