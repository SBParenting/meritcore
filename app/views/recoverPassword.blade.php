@extends('layouts.base')


@section('content')



<section class="panel panel-default " id="recoverPass">
<div class="panel-heading">
	
<strong>Recover Password</strong>

</div>
	<div class="panel-body panel-margins" > 

	<form class="form-horizontal ng-pristine ng-valid" role="form"> 

		<div class="form-group"> 

			<label for="email" class="col-sm-2 control-label">Your Email:</label>

				<div class="col-sm-10">

					<input type="email" class="form-control email"  placeholder="Your Email"/>
				</div>
		</div>


			<div class="form-group">

				<label for="newPassword" class="col-sm-2 control-label">New Password:</label>

					<div class="col-sm-10">

					<input type="password" class="form-control" id="newPassword" placeholder="New Password"/>

					</div>
			</div>	
	
		<div class="form-group">

				<label for="ConfirmPassword" class="col-sm-2 control-label ">Confirm Password:</label>

					<div class="col-sm-10">

					<input type="password" class="form-control"  placeholder="Confirm Password"/>

					</div>
			</div>	

				<div class="form-group form-inline">
			<div class="col-sm-offset-2 col-sm-10">
				
				<button type="submit" class="btn btn-success">Send </button>
				<br/>
						</div>


		</div>
	</form>

	</div>
</section>	





@stop