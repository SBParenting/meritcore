@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="survey-block survey-header">
                <div class="container">
                    <a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}"/></a>

                    <h1 style="color: #666;">LOG IN</h1>
                </div>
            </div>

            <div class="survey-block general-content page-signup">
                <div class="form-inner form-bg">
                    <div class="signup-body"></div>
                    <div class="container register-form">
                        <div class="form-container hide-post-success" id="register-form-width">
                            <span class="line-thru2">Fill in all the information to get back to your family journey </span>

                            <section>
                                {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) }}

                                <div class="form-group">
                                    <div class="input-group input-group-lg">
												
											<span class="input-group-addon">
											<span class=" glyphicon glyphicon-envelope"></span>

											 </span>
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'autocomplete' => 'Off']) }}
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-lg">
												
											<span class="input-group-addon">
											<span class=" glyphicon glyphicon-lock"></span>

											 </span>
                                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'Off']) }}
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <div class="divider"></div>
                                    <button type="submit" class="btn btn-lg btn-block btn-orange">Log in</button>
                                </div>
                            </section>
                            {{ Form::close() }}
                            <section>
                                <p class="text-center"><a href="{{ URL::to('password/remind') }}">Forgot your
                                        password?</a></p>
                                <p class="text-center text-muted">
                                    Don't have an account yet? <a href="{{URL::to('register')}}">Sign up</a>
                                </p>

                                <div class="cycling-logos">Cycling logos</div>
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