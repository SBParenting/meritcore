@extends('front.parents.base')


@section('content')

<div class="container-fluid tour-container" style=" width: 100%; height: 100%; background-color: #a400c7;"> 

		<div class="container-fluid">

		<h1 class="text-center heading"><img src="{{ url('public/front/img/guide-icon.png') }}" height="50px" />tour guide </h1>
			<p class="text-center heading-text" >learn what is coming next on your journey </p>

		 </div>
		 <div class=" container-fluid">

		 <div class="col-md-5 col-md-offset-3 guide-content-top" > 

		 <h2 class="col-md-5 col-md-offset-0 guide-content"><img src="{{ url('public/front/img/reflect-icon.png') }}" height="25px" />REFLECT</h2>

		  </div>

		  <div class="col-md-5 col-md-offset-3 guide-content-inner"> 

		  	<p class="col-md-12">Vivamus ut consequat urna. Vestiblum id turpis ut nisil molestie blandit ac congue mauris. Morbi vitae eros massa</p>

		  	<div class="col-md-10 guide-list"> 
		  	<ol>
		  		<li>Morbi vel ultrices tellus.</li>
		  		<li>Nunc quis nulla a tortor mattis ullamcorper in non lectus. Curabitur rutrum efficitur accusmsan.</li>
		  		<li>Donec facilisis orci lectus, id tempus urna porttitor in.</li>

		  	</ol>
		  	</div>
		  	<div class="col-md-12 screenshot"><img class="img-responsive" src="{{ url('public/front/img/screenshot.png') }}" height="350px" ></div>
		  </div>
</div>

</div>










@stop