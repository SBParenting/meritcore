@extends('front.survey.layout')


@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
				<div class="container">
					<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
					<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
					<a href="#" class="logo"><img src="{{ url('public/front/img/mc-logo.png') }}" /></a>
					<h1>STUDENT SURVEY</h1>
				</div>
			</div>

			<div class="survey-block survey-content">
				<div class="survey-inner">
					
					@include('front.survey.sections.questions')

				</div>
			</div>

			<div class="survey-block survey-footer">
				<div class="container">
					<a href="#" class="pull-left btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
					<a href="#" class="pull-right btn btn-primary">NEXT <i class="glyphicon glyphicon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

@stop