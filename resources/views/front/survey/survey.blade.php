@extends('front.survey.layout')


@section('content')

	<div class="container-page">

		<div class="wrapper">

			@include('front.survey.sections.header')
			{!! Form::open(['class'=>'form-horizontal', 'url' => $key.'/add-info' ]) !!}
			{!! Form::token() !!}

			{!! Form::hidden('secret', $student->secret) !!}
			{!! Form::hidden('student_id', $student->id) !!}
			{!! Form::hidden('campaign_id', $campaign->id) !!}
			<div class="survey-block survey-content" >
				<div class="survey-row">
					<div class="container">
						<table>
							<tr>
								<td>
									<label class="col-md-4 control-label">I  am in</label>
									<div class="col-md-2">{!! Form::radio('survey_id', '1', ($campaign->survey_id == '1')?true:false)!!} HEROES® </div>
									<div class="col-md-2">{!! Form::radio('survey_id', '2', ($campaign->survey_id == '2')?true:false) !!} HEROES® 2 </div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-4 control-label">HEROES® was taught by?.</label>
									<div class="col-md-2">{!! Form::radio('question_1', '1', false)!!} A Volunteer </div>
									<div class="col-md-2">{!! Form::radio('question_1', '2', false) !!} An Instructor </div>
									<div class="col-md-2">{!! Form::radio('question_1', '3', false) !!} A Instructor and A Volunteer </div>
								</td>
							</tr>
							
						</table>
					</div>
				</div>
				<div class="survey-row">
					<div class="container">
						<table>
							<tr>
								<td>
									<label class="col-md-4 control-label">My instructor's approch and style of presenting was enjoyable for me.</label>
									<div class="col-md-2">{!! Form::radio('question_2', '1', false)!!} Yes </div>
									<div class="col-md-2">{!! Form::radio('question_2', '0', false) !!} No </div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-4 control-label">The HEROES® program offered good information that I am able to understand and use.</label>
									<div class="col-md-2">{!! Form::radio('question_3', '1', false)!!} Yes </div>
									<div class="col-md-2">{!! Form::radio('question_3', '0', false) !!} No </div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="survey-row">
					<div class="container">
						<table>
							<tr>
								<td>
									<label class="col-md-4 control-label">We discussed things in the HEROES® classes that are meaningful and important to me.</label>
									<div class="col-md-2">{!! Form::radio('question_4', '1', false)!!} Yes </div>
									<div class="col-md-2">{!! Form::radio('question_4', '0', false) !!} No </div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="col-md-4 control-label">I felt listened to and respected as I participated in the HEROES® classes.</label>
									<div class="col-md-2">{!! Form::radio('question_5', '1', false)!!} Yes </div>
									<div class="col-md-2">{!! Form::radio('question_5', '0', false) !!} No </div>
								</td>
							</tr>
						</table>
					</div>
				</div>
					<div class="survey-block survey-footer visible-xs-block" style="bottom:-50px;">
						<div class="container">
							<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
							<a href="#" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
							<button class="btn btn-primary pull-right inline btn btn-warning" id="btnSurveyNext" type="submit"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
						</div>
					</div>
					</div>

					<div class="survey-block survey-footer hidden-xs" style="bottom:-50px;">
						<div class="container">
							<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
							<a href="#" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
							<button class="btn btn-primary pull-right inline btn btn-warning" id="btnSurveyNext" type="submit"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
						</div>
					</div>
			<div class="survey-block survey-content visible-xs-block">
				<div id="questionsMobileContainer" class="survey-inner">


				</div>
			</div>

			
			{!! Form::close() !!}
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.form-control').change(function(){
				var empty = 0;
				$('.form-control').each(function(){
					if(!$(this).val()){
						empty++;
					}
				});
				if(empty == 0){
					$('#btnSurveyNext').removeClass('disabled');
				}
			});
		});
		var remaining = 3 - $('.survey-block').find('.survey-row').length;

		for (i = 0; i < remaining; i++) {
			$('<div class="survey-row"><div class="container"><table></table></div></div>').insertAfter('.survey-block .survey-row:last');
		}
	</script>

@stop
