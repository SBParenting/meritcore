<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Merit Core | @yield('title')</title>

	<link href="{{ asset("public/admin/libs/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" />
    <link href="{{ asset("public/admin/libs/icheck/custom.css") }}" rel="stylesheet" />
    <link href="{{ asset("public/front/libs/datapicker/datepicker.css") }}" rel="stylesheet" />
	<link href="{{ asset("public/admin/css/theme.css") }}" rel="stylesheet" />
    <link href="{{ asset("public/front/fonts/style.css") }}" rel="stylesheet" />
    <link href="{{ asset("public/front/css/buttons.css") }}" rel="stylesheet" />
	<link href="{{ asset("public/admin/css/admin.css") }}" rel="stylesheet" />
    <link href="{{ asset("public/front/css/front.css") }}" rel="stylesheet" />

</head>

<body class="body-special">

 	@include('common.notifications')

    <div id="loader"><div class="spinner" role="spinner"><div class="spinner-icon"></div></div></div>

	@yield('content')

	<!-- Mainly scripts -->
    <script src="{{ asset("public/admin/libs/jquery/jquery-1.10.2.js") }}"></script>
    <script src="{{ asset("public/admin/libs/bootstrap/bootstrap.min.js") }}"></script>
    <script src="{{ asset("public/admin/libs/icheck/icheck.min.js") }}"></script>
    <script src="{{ asset("public/admin/libs/icheck/icheck.min.js") }}"></script>
    <script src="{{ asset("public/admin/libs/jquery-form/jquery.form.min.js") }}"></script>
    <script src="{{ asset("public/front/libs/history/scripts/bundled/html4+html5/jquery.history.js")}}"></script>
    <script src="{{ asset("public/front/libs/datapicker/datepicker.js")}}"></script>
    <script src="{{ asset("public/front/libs/uploader/jquery.ui.widget.js")}}"></script>
    <script src="{{ asset("public/front/libs/uploader/jquery.iframe-transport.js")}}"></script>
    <script src="{{ asset("public/front/libs/uploader/jquery.fileupload.js")}}"></script>
    <script src="{{ asset("public/admin/libs/bootbox/bootbox.min.js")}}"></script>

    <script src="{{ asset("public/admin/js/api.js") }}"></script>
    <script src="{{ asset("public/admin/js/app.js") }}"></script>
    <script src="{{ asset("public/admin/js/form.js") }}"></script>

    <script src="{{ asset("public/front/js/front.js") }}"></script>
    <script src="{{ asset("public/front/js/manage.js") }}"></script>

</body>

</html>
