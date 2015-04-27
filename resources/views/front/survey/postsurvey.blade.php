@extends('front.survey.layout')


@section('content')

	<div class="container-page">

		<div class="wrapper">

			@include('front.survey.sections.header')

			{!! Form::token() !!}
			{!! Form::open(['class'=>'form-horizontal', 'url' => $key.'/save-post-question' ]) !!}
			{!! Form::hidden('student_id', $student_id) !!}
			{!! Form::hidden('campaign_id', $campaign_id) !!}

			<div class="survey-block survey-content hidden-xs">
				<div class="container">
					<label class="col-md-12 control-label">As a result of participating in the program - please answer yes or no</label>
				</div>
				<div class="container">
				<div class="survey-row">
							<table>
								
				@foreach($questions as $question)
								<tr>
									<td>
										<label class="col-md-8 control-label">{{$question->title}}</label>
										<div class="col-md-2">{!! Form::radio('question['.$question->id.']', '1', false)!!} Yes </div>
										<div class="col-md-2">{!! Form::radio('question['.$question->id.']', '0', false) !!} No </div>
									</td>
								</tr>
								@if($question->question_num % 3 == 0 && $question->question_num != count($question))
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
					</div>

			</div>

			<div class="survey-block survey-content visible-xs-block">
				<div id="questionsMobileContainer" class="survey-inner">


				</div>
			</div>

			<div class="survey-block survey-footer">
				<div class="container">
					<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
					<a href="#" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
					<button class="btn btn-primary pull-right inline btn btn-warning" id="btnSurveyNext" type="submit"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
				</div>
			</div>
		</div>
	</div>

	@include('front.survey.templates.postSurvey')

	@include('front.survey.templates.question_mobile')

		<script type="text/javascript">
		$(document).ready(function(){
			$('input[type = radio]').change(function(){
				var empty = 0;
				$('input[type = radio]').each(function(){
					if($(this).val()){
						empty++;
					}
				});
				if(empty == 0){
					$('#btnSurveyNext').removeClass('disabled');
				}
			});
		});
	</script>

@stop
