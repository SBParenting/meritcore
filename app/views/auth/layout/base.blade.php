<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Merit Core | @yield('title')</title>

	{{ HTML::style("public/admin/libs/font-awesome/css/font-awesome.min.css") }}
    {{ HTML::style("public/admin/libs/iCheck/custom.css") }}
	{{ HTML::style("public/admin/css/theme.css") }}
	{{ HTML::style("public/admin/css/admin.css") }}

</head>

<body class="body-special">

 	@include('common.notifications')
    
    <div id="loader"><div class="spinner" role="spinner"><div class="spinner-icon"></div></div></div>

	@yield('content')

	<!-- Mainly scripts -->
    {{ HTML::script("public/admin/libs/jquery/jquery-1.10.2.js") }}
    {{ HTML::script("public/admin/libs/bootstrap/bootstrap.min.js") }}
    {{ HTML::script("public/admin/libs/iCheck/icheck.min.js") }}
    {{ HTML::script("public/admin/libs/jquery-form/jquery.form.min.js") }}
    
    {{ HTML::script("public/admin/js/api.js") }}    
    {{ HTML::script("public/admin/js/app.js") }}
    {{ HTML::script("public/admin/js/form.js") }}

</body>

</html>
