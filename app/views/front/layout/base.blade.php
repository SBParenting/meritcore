<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Front</title>

    {{ HTML::style("//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css") }}
    {{ HTML::style("//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css") }}
    {{ HTML::style("public/front/css/style.css") }}

</head>

<body>

    @include('front.partials.nav')

    <div class="container">

        @yield('content')

    </div>

    <!-- Mainly scripts -->
    {{ HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js") }}
    {{ HTML::script("//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js") }}
</body>
</html>
