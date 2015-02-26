@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="survey-block survey-header">
                <div class="container">
                    <a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}"/></a>

                    <h1 style="text-align: center; color: #666;">SUCCESS</h1>
                </div>
            </div>

            <div class="survey-block survey-content page-signup">
                <div class="form-inner form-bg">
                    <div class="signup-body"></div>
                    <div class="container register-form">

                        <div class="form-container hide-post-success" id="register-form-width">

                            <section style="color:black">
                                <h2>Thank you!</h2>

                            </section>


                        </div>

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