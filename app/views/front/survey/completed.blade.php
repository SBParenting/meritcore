@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="survey-block survey-header">
                <div class="container">
                    <a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}"/></a>

                    <h1 style="text-align: center; color: #666;"></h1>
                </div>
            </div>

            <div class="survey-block survey-content">
                <div class="form-inner form-bg">
                    <div class="container" style="text-shadow:0 1px 0 #FFF;color:#888;text-align: center;padding-top:20px;">

                        <span><i class="fa fa-smile-o fa-5x"></i></span>

                        <h1>You completed the survey, thank you!</h1>

                        <p>Bacon ipsum dolor amet tail jerky filet mignon, chicken bresaola pastrami ball tip tenderloin
                            drumstick pork loin shankle short loin ground round. Filet mignon shank cow rump short loin.
                            Tail bacon short ribs kevin bresaola ribeye ground round ham porchetta meatball. Fatback
                            pork loin tenderloin biltong boudin turkey. Alcatra pastrami rump turducken, ham hock tail
                            sausage doner.</p>

                        <br />
                        <br />

                        <a href="/">< Back to the children list</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@stop
@section('script')

    {{ HTML::script("public/admin/libs/jquery-form/jquery.form.min.js") }}

    {{ HTML::script("public/admin/js/api.js") }}
    {{ HTML::script("public/admin/js/app.js") }}
    {{ HTML::script("public/admin/js/form.js") }}

@stop

@section('css')

    {{ HTML::style("public/front/css/main.css") }}

@stop