<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Front</title>

    {{ HTML::style("public/front/libs/bootstrap/css/bootstrap.min.css") }}
    {{ HTML::style("public/front/libs/bootstrap/css/bootstrap-theme.min.css") }}
    {{ HTML::style("public/front/libs/font-awesome/css/font-awesome.min.css") }}
    {{ HTML::style("public/front/css/style.css") }}

    {{ HTML::script("public/front/libs/modernizr/modernizr.js") }}

</head>

<body>

    @include('front.partials.nav')

    <div class="container">

        @yield('content')

    </div>

    {{ HTML::script("public/front/libs/jquery/jquery.min.js") }}
    {{ HTML::script("public/front/libs/bootstrap/js/bootstrap.min.js") }}
    
</body>
</html>
