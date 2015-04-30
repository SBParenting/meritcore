<!DOCTYPE html>
<html>

<head>

	<title>Meritcore | @yield('title')</title>
	<link href="{{ asset("public/front/css/print.css") }}" rel="stylesheet" />    
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
