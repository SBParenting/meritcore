@extends ('layouts.admin')


@section('content')

<section class="panel panel-default ">
	
<div class="panel-heading center-text">
	<strong>Add Child</strong>

</div>
<div class="panel-body " id="center-inputs" >
	
	<form class="form-horizontal ng-pristine ng-valid " role="form">
		<div class="col-sm-10">
	<div class="form-group">
		<label class="control-label col-sm-1" for="firstname">First Name:</label>
		<input type="text" class="form-control" id="firstname" placeholder="First Name"/>
		</div>
	<div class="form-group">
<label class="control-label col-sm-1" for="lastname">Last Name:</label>
		<input type="text" class="form-control" id="lastname" placeholder="Last Name"/>

	</div>

	<div class="form-group">
		
		<label class="control-label col-sm-1" for="dateOfBirth">Birth Date:</label>
		<input type="text" class="form-control col-sm-10" id="dateOfBirth" placeholder=" yyyy/mm/dd"/>

	</div>
</div>


<div class=" col-sm-10 col-sm-offset-2">


	
<button type="submit" class="btn btn-success ">Finish</button>

</div>


	</form>

</div>








</section>


@stop