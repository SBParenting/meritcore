<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Merit Core | @yield('title')</title>

	<link href="{{ asset("public/admin/libs/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" />
    <link href="{{ asset("public/admin/libs/icheck/custom.css") }}" rel="stylesheet" />
	<link href="{{ asset("public/admin/css/theme.css") }}" rel="stylesheet" />
	<link href="{{ asset("public/admin/css/admin.css") }}" rel="stylesheet" />

</head>

<body class="body-special">

 	@include('common.notifications')

    <div id="loader"><div class="spinner" role="spinner"><div class="spinner-icon"></div></div></div>

	@yield('content')

	<!-- Mainly scripts -->
    <script src="{{ asset("public/admin/libs/jquery/jquery-1.10.2.js") }}"></script>
    <script src="{{ asset("public/admin/libs/bootstrap/bootstrap.min.js") }}"></script>
    <script src="{{ asset("public/admin/libs/icheck/icheck.min.js") }}"></script>
    <script src="{{ asset("public/admin/libs/jquery-form/jquery.form.min.js") }}"></script>

    <script src="{{ asset("public/admin/js/api.js") }}"></script>
    <script src="{{ asset("public/admin/js/app.js") }}"></script>
    <script src="{{ asset("public/admin/js/form.js") }}"></script>

</body>

</html>
