
@foreach ($questions as $question)

	<div class="survey-row">
		

		<div class="container">
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
						
							
								
								
									<div class="slider ui-slider ui-slider-handle ui-slider-horizontal "></div>

							

							</div>

						</div>
						<br/>
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
        range: false,
        min: 5,
      	max: 100,
        value: 50,
        step: .01,
        animate: true,
        start: function(){

        	$('.ui-slider-horizontal .ui-slider-handle:first').css({
        		"background": " url('/public/front/img/boy-avatar.png')",
        		padding: '18px', 
        		top: "-15px"

        	});


        }
        ,
   		slide: function(){
   			$(this).add().css({ 

		"background": " #fdb535"


});


   		}

        
    });

$('.ui-slider-horizontal').height(3);



$('.ui-slider-horizontal .ui-slider-handle').css({
	borderRadius: "80px" ,
	top: "-27px",
	opacity: '4',
	border: "none",
	padding: "28px" ,

	"background": "url('/public/front/img/default-circle.png') ",
	"background-position": "center",

});


</script>
@stop


@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

@stop