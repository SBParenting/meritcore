@extends('front.survey.layout')


@section('content')

	<div class="container-page">

		<div class="wrapper">

			@include('front.survey.sections.header')

			{!! Form::token() !!}

			{!! Form::hidden('secret', $student->secret) !!}

			<div class="survey-block survey-content hidden-xs">
				<div id="questionsContainer" class="survey-inner">


				</div>
			</div>

			<div class="survey-block survey-content visible-xs-block">
				<div id="questionsMobileContainer" class="survey-inner">


				</div>
			</div>

			<div class="survey-block survey-footer">
				<div class="container">
					<a href="#" id="btnSurveyBack" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
					<a href="/{!! $key !!}/confirm" id="btnSurveyComplete" class="pull-right inline btn btn-warning closed" data-url="{{ url("api/survey/$key/complete") }}"><i class="glyphicon glyphicon-ok"></i> COMPLETE SURVEY</a>
					<a href="#" id="btnSurveyNext" class="pull-right btn btn-warning disabled">NEXT <i class="glyphicon glyphicon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	@include('front.survey.templates.question')

	@include('front.survey.templates.question_mobile')

	<script>

			jQuery(function() {
				$.surveyQuestions = {!! json_encode($questions) !!}
			});

	</script>

@stop
