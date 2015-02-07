@extends('front.survey.layout')

@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
			<a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
				<div class="container">
				<a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
					<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
					 
					 <div class="col-md-7" style="float: right;">
					<div class="logo child-selected"></div>
							<h1 class="logo">Child Selection</h1>

						</div>	

				</div>
			</div>

			<div class="survey-block survey-content page-signup">

				<div class="form-inner add-child-form">
		<div class="purchase-app-btn">
		<button class="btn btn-orange btn-lg">Purchase App </button>
</div>
					<div class="row col-md-8 select-child" style=" float: right;">
						
							<a href="{{URL::to('children/add')}}"><img class="select-child-mouseover" src="/public/front/img/add-child.png"></a>
					</div>

				</div>
			</div>

		</div>
	</div>
@stop

@section('css')

{{ HTML::style("public/front/css/main.css") }}

@stop


