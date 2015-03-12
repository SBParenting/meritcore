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
					
				<table class="col-md-12" >
					<tr>
					<td class="build-select-button "> 
							<p><img src="/public/front/img/select-icon.png">Select</p>
						</td>
						<td class="build-question-content-mid  col-md-5" >
							<h2 class=" text-center">Listen more than you talk:</h2>
								<div class=" col-md-12 rating-content ">
							<center>
							<p class="text-center">how you rated it</p>
						
							<input class="rating ">
							</center>
							
														
							 </div>

						</td>
						<td class="build-question-content-right  col-md-5">
						<p >Creating an enviroment where your child and other family members feel safe to talk and share their feelings is essential to healthy communication. As a parent, thism eans listening and trying to clearly understand what is being communicated before responding.</p>
						<br>
						<br>
						<p><em>For more information, go to the site:</em><br> 
						<a> http://school.familyeducation.com/listening/school-readiness/38350.html </a>
						</p>
						<div>
						</td> 
					 </tr>
				 </table>
				</div> 
			</div>
			<div class="build-question-container col-md-8 col-md-offset-2">
				<div class="build-question-inner col-md-12" >
					
				<table >
					<tr>
					<td class="build-completed-button"> 
							<p>Completed</p>
						</td>
						<td class="build-question-content-mid-2  col-md-5" >
							<h2 class=" text-center">Catch your child doing something right:</h2>
							<div class=" col-md-12 rating-content-2 ">
							<center>
							<p class="text-center">how you rated it</p>
						
							<input class="rating ">
							<p class="text-center revisit">REVISIT THIS STRATEGY</p>
							</center>
							
														
							 </div>
						</td>
						<td class="build-question-content-right-2  col-md-5">
						<p >Make sure to notice when your child acts in positive ways by thanking them and saying something like: "that was very thoughtful". By reinforcing what you want your child to lean, he or she is much more likely to do the same thing in the future. If you see your child doing something you don't want them to do, make sure to explain what you want them to do in the future. Just focusing on what you don't want your child to dodoes not clearly tell them how you expect them to handle similar situations in the future.</p>
						<br>
						<br>
						<div>
						</td> 
					 </tr>
				 </table>
				</div> 
			</div>
			<div class="build-question-container col-md-8 col-md-offset-2">
				<div class="build-question-inner col-md-12" >
					
				<table>
					<tr>
					<td class="build-working-button "> 
							<p>Working On</p>
						</td>
						<td class="build-question-content-mid-3  col-md-5" >
							<h2 class=" text-center">Notice and care:</h2>
							<div class=" col-md-12 rating-content-3 ">
							<center>
							<p class="text-center">rate how it worked for you</p>
						
							<input class="rating ">
							<p class="text-center revisit">REVISIT THIS STRATEGY</p>
							</center>
							
														
							 </div>
						</td>
						<td class="build-question-content-right-3  col-md-5">
						<p >Notice when your child is feeling sad, frustrated, angry, afraid or uncomfortable. Help him or her label these feelings and explore why he or she is feeling this what (i.e. "you seem to be feeling really sad right now, what is going on?"). Maintain eye contact and tell him or her that you understand by saying "dont worry everythign will be ok".</p>
						<br>
						<br>
					
						<div>
						</td> 
					 </tr>
				 </table>
				</div> 
			</div>
		</div>
		 </div>
		 <div class="container-fluid">	<a href="{{URL::to('parents/explore')}}" class="pull-left btn btn-lg btn-primary list-back-btn"><i class="glyphicon glyphicon-arrow-left"></i> Back</a> </div>
	</div>
		
	

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