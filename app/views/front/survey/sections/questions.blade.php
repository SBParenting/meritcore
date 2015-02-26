
@foreach ($questions as $question)

	<div class="survey-row"  data-child-id="{{$child->id}}" data-question-id="{{$question->id}}" data-campaign-student-id="{{$campaign_student->id}}">
		<div class="container ">
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
						<div  class="">
                            <div class="slider" data-answer="{{isset($answers[$question->id]) ? $answers[$question->id] : -1}}">
                                <div>
                                    <img src="/public/front/img/grey-circle.png" class="grey-circle" height="18px" width="18px">
                                    <img src="/public/front/img/orange-circle.png"  class="orange-circle" height="18px" width="18px">
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

       change: function(e,ui){
           var cid  = $(this).parents('.survey-row').attr('data-child-id'),
               qid  = $(this).parents('.survey-row').attr('data-question-id'),
               csid = $(this).parents('.survey-row').attr('data-campaign-student-id');

           $.post("/survey/save",{
               child_id: cid,
               question_id: qid,
               campaign_student_id: csid,
               result: ui.value
           });
       }
    }).each(function(){
        if ($(this).attr('data-answer') != "-1") {
            console.log($(this).attr('data-answer'));
            $(this).slider('value',$(this).attr('data-answer'));
        }

        $(this).find('.ui-slider-handle').css({
            borderRadius: "80px" ,
            top: "-28px",
            opacity: '4',
            border: "none",
            padding: "28px" ,
            "z-index": '4',
            "background": "url('/public/front/img/default-circle.png') ",
            "background-position": "center"
        });

        if ($(this).attr('data-answer') != "-1") {
            console.log($(this).find('.ui-slider-handle'));
            $(this).find('.ui-slider-handle').css({
                "background": "url('/public/front/img/white-circle.png')",
                "text-align": "center",
                padding: '12px 0 0 0',
                width: '43px',
                height: '47px',
                borderRadius: "80px" ,
                border: "none",
                opacity: '4',
                "z-index": '4',
                top: "-22px"
            }).html($(this).attr('data-answer'));
        }

        $('.question-strength , .answers').find('.list-item').css({'background-color': 'transparent'}).find('a').css({"color": '#777777'});
        var color = $(this).parents('.survey-row').css('background-color');

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


    });

$('.ui-slider-horizontal').height(3);





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