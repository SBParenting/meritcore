<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		 
		

	<title>Meritcore | @yield('title')</title>
	<link href="{{ asset("public/front/css/print.css") }}" rel="stylesheet" /> 
	<link href="{{ asset("public/admin/css/admin.css") }}" rel="stylesheet" />
    <script src="{{ asset("public/admin/libs/jquery/jquery-1.10.2.js") }}"></script>
    <script src="{{ asset("public/admin/libs/bootstrap/bootstrap.min.js") }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="{{ asset("public/front/libs/morris/morris.min.js") }}"></script>

</head>

<body>
	<div class="no-margin">
		@yield('page1')
	</div>
	<div>
		@yield('content')
	</div>
	<div class="no-margin">
		@yield('page4')
	</div>
</body>

</html>
