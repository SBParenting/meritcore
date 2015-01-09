<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/assets/styles/main.css">

	</head>
	<body>
	<section data-ng-include =" 'views/header.html' " id="header" class="top-header ng-scope">
		
		<header class="clearfix ng-scope">
		
		<a href="#/" data-toggle-min-nav class="toggle-min"> 

			<i class="fa fa-bars">
				

			</i>

		</a>

		<div class="logo">
			
			<a href="#">
				
			<span class="ng-binding">Admin</span>

			</a>

		</div>

		<div class="menu-button" toggle-off-canvas>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</div>

		</header>
	</section>


	<aside data-ng-include=" 'views/nav.html ' " id="nav-container" class="ng-scope">
		
	<div id="nav-wrapper" class="ng-scope">
		
		<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
			
			<ul id="nav" data-ng-controller="NavCtrl" data-collapse-nav data-slim-scroll data-highlight-active class="ng-scope" style="overflow: hidden; width: auto; height: 100%;">
				<li class="active">
				 	
					<a href="#/childList">
						<i class="fa fa-dashboard">
							
						<span class="icon-bg bg-danger"></span>

						</i>

						<span data-i18n="Child List">Child List</span>



					</a>

				</li>


			</ul>


		</div>



	</div>






	</aside>
<div class="view-container">
<section data-ng-view id="content" class="animate-fade-up ng-scope">
	<div class="page page-table ng-scope">
@yield('content')

</div>
</section>
</div>



</body>







</html>