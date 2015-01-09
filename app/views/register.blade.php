@extends ('layouts.base')

@section('content')
<section class="panel panel-default ">
	
<div class="panel-heading center-text">
	<strong>Registration Form</strong>

</div>
<div class="panel-body " id="center-inputs" >
	
	<form class="form-horizontal ng-pristine ng-valid " role="form">
		<div class="col-sm-10">
	<div class="form-group form-inline">
		<label class="sr-only" for="firstname">First Name</label>
		<input type="text" class="form-control" id="firstname" placeholder="First Name"/>
<label class="sr-only" for="lastname">Last Name</label>
		<input type="text" class="form-control" id="lastname" placeholder="Last Name"/>
	</div>
</div>


<div class="form-group form-horizontal">
		<div class="col-sm-10">
		<label class="sr-only " for="email">Email</label>
		<input type="text" class="form-control " id="email" placeholder="Email"/>
		</div>
	</div>

<div class="form-group form-inline">
<div class="col-sm-10">
		<label class="sr-only" for="password">Password</label>
		
		<input type="password" class="form-control" id="password" placeholder="Password"/>
<label class="sr-only" for="confirmPassword">Confirm Password</label>

		<input type="text" class="form-control" id="confirmPassword" placeholder="Confirm Password"/>

	</div>
</div>
<div>
	
<button type="submit" class="btn btn-success col-sm-1 ">Register</button>

</div>


	</form>

</div>








</section>
@stop