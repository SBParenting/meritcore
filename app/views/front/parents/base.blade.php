<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Front</title>
    {{HTML::style("public/front/libs/bootstrap/css/bootstrap.min.css") }}
    {{ HTML::style("public/front/libs/font-awesome/css/font-awesome.min.css") }}
    {{ HTML::style("public/front/libs/menu/component.css") }}
    {{ HTML::style("public/front/libs/scroller/scroller.css") }}
    {{ HTML::style("public/front/fonts/style.css") }}
    {{ HTML::style("public/front/css/survey.css") }}
    {{ HTML::script("public/front/libs/modernizr/modernizr.js") }}
    {{HTML::style("public/admin/css/theme.css")}}
    @yield('css')

</head>

<body>
   
    
        
        @yield('content')


        

  

    {{ HTML::script("public/front/libs/jquery/jquery.min.js") }}
    {{ HTML::script("public/front/libs/bootstrap/js/bootstrap.min.js") }}
    {{ HTML::script("public/front/libs/menu/classie.js") }}
    {{ HTML::script("public/front/libs/menu/menu.js") }}
    {{ HTML::script("public/front/libs/scroller/scroller.js") }}
    {{ HTML::script("public/front/js/survey.js") }}
    
    @yield('script')

</body>
</html>
