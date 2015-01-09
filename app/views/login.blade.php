@extends('layouts.base')

@section('content')
<section class="panel panel-default login-margins">
<div class="panel-heading">
	
<strong>Login</strong>


</div>
	<div class="panel-body " > 

	<form class="form-horizontal ng-pristine ng-valid" role="form"> 

		<div class="form-group"> 

			<label for="email" class="col-sm-2 control-label" >Email:</label>

				<div class="col-sm-10">
					<input type="email" class="form-control" id="emailInput" placeholder="Email"/>
				</div>
		</div>


			<div class="form-group">

				<label for="password" class="col-sm-2 control-label">Password:</label>

					<div class="col-sm-10">

					<input type="password" class="form-control" id="password" placeholder="Password"/>

					</div>
			</div>	
	
		<div class="form-group">
			
			<div class="col-sm-offset-2 col-sm-10">
				
				<div class="checkbox">
						
						<label>
							<input type="checkbox">
							Remember me

						</label>
						
				</div>
			</div>


		</div>

				<div class="form-group form-inline">
			<div class="col-sm-offset-2 col-sm-10">
				
				<button type="submit" class="btn btn-success">Sign In </button>
				<br/>
						</div>


		</div>
	</form>

	</div>
</section>	


@stop

