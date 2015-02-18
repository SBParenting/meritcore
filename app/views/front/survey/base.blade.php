@extends('front.survey.layout')


@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
			<a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
				<div class="container">
					<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
					<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
						
						<div class="child-image">
						<a href="#" class="logo"><div class="logo child-thumbnail"></div>
							<p class="child-name">Child name</p></a>
							</div>
					<h1 class="survey-name" >CHILD SURVEY</h1>
					<span class="show-name">Childs name</span>
					<div class="bar-container">
						<span class="progress-label-1">PARENT FOCUS</span>
					<span class="progress-label-2">CHILD SURVEY</span>
				<div class="progress ng-isolate-scope progress-bar-container" max="max" value="dynamic">
			
  <div class="progress-bar progress-blue" ng-class="type &amp;&amp; 'progress-bar-' + type" role="progressbar" aria-valuenow="91" aria-valuemin="0" aria-valuemax="200" ng-style="{width: percent + '%'}" aria-valuetext="46%" ng-transclude="" style="width: 10%;"><span class="ng-binding ng-scope">10/10</span></div>
   <div class="progress-bar progress-green" ng-class="type &amp;&amp; 'progress-bar-' + type" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="200" ng-style="{width: percent + '%'}" aria-valuetext="46%" ng-transclude="" style="width: 60%;"><span class="ng-binding ng-scope">30/62</span></div>

</div>
</div>
				</div>
				
			</div>
			
			<div class="survey-block survey-content">
			<div class="question-strength">
			<ul> 
			<li class="list-item" id="strongly-agree"><a>strongly <br/> agree</a></li>
			<li class="list-item" id="agree"><a>agree</a></li>
			<li class="list-item" id="not-sure"><a>not sure</a></li>
			<li class="list-item" id="disagree"><a>disagree</a></li>
			<li class="list-item" id="strongly-disagree"><a>strongly<br> disagree</a></li>




			</ul>



			 </div>
				<div class="survey-inner">
					
					@include('front.survey.sections.questions')

				</div>
			</div>

			<div class="survey-block survey-footer">
				<div class="container btn-container">

					<a href="#" class="pull-left btn btn-primary btn-left"><i class="glyphicon glyphicon-arrow-left"></i> BACK</a>
					<a href="#" class="pull-right btn btn-primary btn-right">NEXT <i class="glyphicon glyphicon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

@stop