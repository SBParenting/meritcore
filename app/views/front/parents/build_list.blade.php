@extends('front.parents.base')

@section('content')


<div class="build-list-container"  >

	<div class="container-fluid list-content">

			<div class="container-fluid top-section">
			<h1 class="text-center">BUILD</h1>
			<p class="text-center">SELECT a strategy to work on with your child</p>
			</div>

		<div class="container-fluid content-container scrollbar-vista" >
			<div class="build-question-container col-md-8 col-md-offset-2">
				<div class="build-question-inner col-md-12" >
					
				<table>
					<tr>
					<td class="build-select-button "> 
							<p><img src="/public/front/img/select-icon.png">Select</p>
						</td>
						<td class="build-question-content-mid  col-md-4" >
							<h2 class=" text-center">Listen more than you talk:</h2>
							<div class=" col-md-12 rating-content ">
							<p class="text-center">overall parent rating</p>
							<div class="rate-stars">
							<input class="rating ">
							<div>
							 </div>
						</td>

						
						<td class="build-question-content-right  col-md-5">
						<p >Creating an enviroment where your child and other family members feel safe to talk and share their feelings is essential to healthy communication. As a parent, thism eans listening and trying to clearly understand what is being communicated before responding.</p>
						<p><em>For more information, go to the site:</em><br> 
						<a> http://school.familyeducation.com/listening/school-readiness/38350.html </a>
						</p>
						<div>
				
							</td> 
					 </tr>




				 </table>





				</div> 
			</div>
		</div>
	</div>
		 </div>
		 <div class="container-fluid">	<a href="{{URL::to('parents/explore')}}" class="pull-left btn btn-lg btn-primary list-back-btn"><i class="glyphicon glyphicon-arrow-left"></i> Back</a> </div>
	

@stop
@section('script')
{{HTML::script("public/front/libs/bootstrap-star/js/star-rating.js")}}
	<script> 
	$(".rating").rating(['min'=>1, 'max'=>10, 'step'=>2, 'size'=>'lg' , 'showCaption'=>false]);

	</script>
@stop


@section('css' )
{{HTML::style("public/front/libs/scrollbar/css/jquery.scrollbar.css")}}
{{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}

@stop