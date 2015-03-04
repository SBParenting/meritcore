@extends('front.parents.base')

@section('content')

<div class="container-page">

	<div class="wrapper"> 

		<div class="container-fluid">
			<div class="col-md-12 info-header"> 
				<h1 class=" text-center">FAMILY SUPPORT &amp; EXPECTATIONS</h1>
			</div>

			<div class=" col-md-12 info-inner"> 
			<h1 class=" col-md-6 col-md-offset-3"><i class=" glyphicon glyphicon-edit"></i>Family Communication </h1>
			<p class="col-md-6 col-md-offset-3">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishingLorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishin</p>


			</div>

			<div class="info-percent col-md-12">
				<div class=" col-md-2 col-md-offset-3 last-score">
					<p class="text-center">last survey score</p>
					<p class="text-center percent-1">37%</p>
					<p class="text-center">January 31, 2014</p>
				 </div>

				 	<div class=" col-md-2 current-score">
				 	<span>
					<p class="text-center">child's present score</p>
					<p class="text-center percent-2">52%</p>
					<span>
				 </div>

				 	<div class=" col-md-2  room-to-grow">
					<p class="text-center">room to grow</p>
					<p class="text-center percent-3">48%</p>
			
				 </div>
			 </div>
<div class="progress col-md-6 col-md-offset-3 ng-isolate-scope info-progress-bar" max="max" value="dynamic">
   <div class="progress-bar	 info-progress" ng-class="type &amp;&amp; 'progress-bar-' + type" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="200" ng-style="{width: percent + '%'}" aria-valuetext="100%" ng-transclude="" style="width: 100%; background-color: #1d5c2e;"><span class="ng-binding ng-scope">30/62</span></div>
</div>
	

		

		 </div>

<div class=" container-fluid">
<div class=" col-md-3 col-md-offset-3">
				<a href="#" class="pull-right btn btn-lg btn-warning btn-continue "><i class="glyphicon glyphicon-arrow-right"></i> Continue</a>	
				<a href="#" class="pull-left btn btn-lg btn-primary  button-back "><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
</div>
		 </div>

<div class=" container-fluid">

<a href="" class="slide-back col-md-3"><i class="glyphicon glyphicon-circle-arrow-left"></i> </a>

 </div>


	</div>







	
</div>
@stop


@section('css')
{{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}
{{ HTML::style("public/front/css/main.css") }}

@stop