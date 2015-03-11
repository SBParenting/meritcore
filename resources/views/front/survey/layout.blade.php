<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Front</title>

    <link href="{{ asset("/public/front/libs/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" />
    <link href="{{ asset("/public/front/libs/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" />
    <link href="{{ asset("/public/front/libs/menu/component.css") }}" rel="stylesheet" />
    <link href="{{ asset("/public/front/libs/scroller/scroller.css") }}" rel="stylesheet" />
    <link href="{{ asset("/public/front/fonts/style.css") }}" rel="stylesheet" />
    <link href="{{ asset("/public/front/css/buttons.css") }}" rel="stylesheet" />
    <link href="{{ asset("/public/front/css/survey.css") }}" rel="stylesheet" />

    <script src="{{ asset("/public/front/libs/modernizr/modernizr.js") }}"></script>
    <script src="{{ asset("/public/front/libs/jquery/jquery.min.js") }}"></script>

</head>

<body>

    <div id="perspective" class="perspective">

        @yield('content')

        @include('front.survey.partials.nav')

        @include('front.survey.partials.help')

    </div>

    <script src="{{ asset("/public/front/libs/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("/public/front/libs/menu/classie.js") }}"></script>
    <script src="{{ asset("/public/front/libs/menu/menu.js") }}"></script>
    <script src="{{ asset("/public/front/libs/scroller/scroller.js") }}"></script>
    <script src="{{ asset("/public/admin/js/api.js") }}"></script>
    <script src="{{ asset("/public/admin/js/app.js") }}"></script>
    <script src="{{ asset("/public/front/js/survey.js") }}"></script>

</body>
</html>
