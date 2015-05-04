@extends('front.survey.layout')


@section('content')

	<div class="container-page">

		<div class="wrapper">

			@include('front.survey.sections.header',['label'=>'As a result of participating in the program - please answer yes or no','width'=>'100%'])

			{!! Form::token() !!}
			{!! Form::open(['class'=>'form-horizontal', 'url' => $key.'/save-post-question' ]) !!}
			{!! Form::hidden('student_id', $student_id) !!}
			{!! Form::hidden('campaign_id', $campaign_id) !!}
			
			<div class="survey-block survey-content">

				<div class="survey-row">
						<div class="container">
							<label class="col-md-12 control-label  hidden-xs" style="color:white;text-align:right;padding-right:8%;">All questions need to be filled</label>
							<table>
							<?php $count = 0; ?>
								@foreach($questions as $question)
									<tr>
										<td>
											<label class="col-md-8 control-label" style="margin-bottom:30px;">{{$question->title}}</label>
											<div class="col-md-2"><label>{!! Form::radio('question['.$question->id.']', '1', false)!!} Yes </label></div>
											<div class="col-md-2"><label>{!! Form::radio('question['.$question->id.']', '0', false) !!} No </label></div>
										</td>
									</tr>
									
									<?php $count++; ?>
									
									@if($count >= 2)
										<?php $count=0; ?>
										</table>
										</div>
										</div>
										<div class="survey-row">
										<div class="container">
										<table>
									@endif
								@endforeach
							</table>
						</div>
						<div class="survey-block survey-footer visible-xs-block" style="bottom:-50px;">
						<div class="container">
							<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
							<a href="#" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
							<button class="btn btn-primary pull-right inline btn btn-warning next disabled" id="btnSurveyNext" type="submit"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
						</div>
					</div>
					</div>

					<div class="survey-block survey-footer hidden-xs" style="bottom:-50px;">
						<div class="container">
							<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
							<a href="#" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
							<button class="btn btn-primary pull-right inline btn btn-warning next disabled" id="btnSurveyNext" type="submit"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
						</div>
					</div>

			</div>

			<div class="survey-block survey-content visible-xs-block">
				<div id="questionsMobileContainer" class="survey-inner">


				</div>
			</div>

			
		</div>
	</div>

	@include('front.survey.templates.postSurvey')

	@include('front.survey.templates.question_mobile')

	<script type="text/javascript">
		$(document).ready(function(){
			$('input[type=radio]').on('load change',function(){
				var empty = 0;
				if ($('input[type=radio]:checked').length >= {!! count($questions) !!} ){
					empty++;
				}
				if(empty != 0){
					$('.next').removeClass('disabled');
				}
			});
		});

		var remaining = 5 - $('.survey-block').find('.survey-row').length;

		for (i = 0; i < remaining; i++) {
			$('<div class="survey-row"><div class="container"><table></table></div></div>').insertAfter('.survey-block .survey-row:last');
		}
	</script>

@stop
