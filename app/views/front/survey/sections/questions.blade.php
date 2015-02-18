
@foreach ($questions as $question)

	<div class="survey-row  ">
		

		<div class="container hidden-xs">
			<table>
				<tr>
					<td>
						<span class="circle-number fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<span class="fa color">{{ $question->num }}</span>
						</span>
					</td>
						<td>{{ $question->question }}</td>
					<td>
						<div  class="" data-url="{{ url('api.survey.save') }}" data-value="1" data-question-id="{{ $question->id }}">	
								<div class="slider">
									<div>
										<img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px" style="position: relative; top: -11px; left: -4px; z-index: 2;">
										<img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px" style="float: right; position: relative; top: -8px; right: -4px;">
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
		
	

@endforeach

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
        slide:  function(e,ui){
        		
        	$(this).find('.ui-slider-handle').css({
        		"background": " url('/public/front/img/white-circle.png')",
        		"text-align": "center",
        		padding: '12px 0 0 0',
                width: '43px',
                height: '47px',
        		top: "-22px"
        	});

			$('.question-strength , .answers').find('.list-item').css({'background-color': 'transparent'}).find('a').css({"color": '#777777'});

			var color = $(this).parents('.survey-row').css('background-color');

            $(this).find('.ui-slider-handle').html(ui.value);

        	$.each($('.slider'),function(){
        		var position = $(this).slider("option", "value");
        		if ($(this).find('.ui-slider-handle').css('background-image') == "url(http://meritcore.local/public/front/img/white-circle.png)") {
        	
	        		if (position >= 0 && position <= 20) {
	        			$('#strongly-agree, #not-at-all').css({"background-color": color}).find('a').css({"color": '#ffffff'});
	        		}

	        		if (position >= 20 && position <= 40) {
	        			$('#agree , #not-so-much').css({"background-color": color}).find('a').css({"color": '#ffffff'});
	        		}
        			if (position >= 40 && position <= 60) {
	        			$('#not-sure').css({"background-color": color }).find('a').css({"color": '#ffffff'});
	        		}
	        	
    				if (position >= 60 && position <= 80) {
	        			$('#disagree , #somewhat-concern').css({"background-color": color }).find('a').css({"color": '#ffffff'});
	        		}
					if (position >= 80 && position <= 100) {
	        			$('#strongly-disagree , #major-concern ').css({"background-color": color }).find('a').css({"color": '#ffffff'});
	        		}
        			
        		}


        	});
        },

       change: function(){}
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
<link rel="stylesheet" href="/public/front/css/survey.css">
@stop