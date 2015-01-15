<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Merit Core | @yield('title')</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet" type="text/css">
    {{ HTML::style("public/admin/libs/font-awesome/css/font-awesome.min.css") }}
    {{ HTML::style("public/admin/libs/icheck/custom.css") }}
    {{ HTML::style("public/admin/libs/datapicker/datepicker3.css") }}
    {{ HTML::style("public/admin/libs/summernote/summernote.css") }}
    {{ HTML::style("public/admin/libs/summernote/summernote-bs3.css") }}
    {{ HTML::style("public/admin/libs/dropzone/basic.css") }}
    {{ HTML::style("public/admin/libs/dropzone/dropzone.css") }}
    {{ HTML::style("public/admin/css/theme.css") }}
    {{ HTML::style("public/admin/css/animate.css") }}
    {{ HTML::style("public/admin/css/admin.css") }}

</head>

<body class="{{ $locked ? 'app-locked' : '' }}">

    @include('common.notifications')
    
    <div id="loader">
        <div class="spinner" role="spinner">
            <div class="spinner-icon"></div>
        </div>
    </div>

    <section id="header" class="top-header">

        @include('admin.partials.header')

    </section>

    <aside id="nav-container">

        @include('admin.partials.nav')

    </aside>

    <div class="view-container">

        <section id="content" class="animated fadeInUp">
                
                @yield('content')

        </section>

    </div>

    <section id="lockScreen" style="background: url({{ url("public/admin/images/background/".rand(1,5).".jpg") }})">

        <div class="page page-lock">

            <div class="lock-centered clearfix">
                <div class="lock-container">
                    <!-- <div ui-time class="lock-time"></div> -->
                    
                    <section class="lock-box">
                        <div class="lock-user">{{ Auth::user()->getName('F') }}</div>
                        <div class="lock-img"><img src="{{ Auth::user()->avatar(150) }}" alt=""></div>
                        <div class="lock-pwd">
                            <form class="unlock-form">
                                <div class="form-group">
                                    <input name='password' type="password" placeholder="Password" class="form-control">
                                    <a href="{{ url('unlock') }}" class="btn-submit js-post-unlock">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </form>
                        </div>

                    </section>

                    <section class="lock-sub">
                        <p class="text-center text-muted text-small"><a href="{{ url('logout') }}">Log out of account</a></p>
                    </section>

                </div>
            </div>

        </div>

    </section>

    
    <!-- Library scripts -->
    {{ HTML::script("public/admin/libs/jquery/jquery-1.10.2.js") }}
    {{ HTML::script("public/admin/libs/bootstrap/bootstrap.min.js") }}
    {{ HTML::script("public/admin/libs/icheck/icheck.min.js") }}
    {{ HTML::script("public/admin/libs/jquery-form/jquery.form.min.js") }}
    {{ HTML::script("public/admin/libs/summernote/summernote.min.js") }}
    {{ HTML::script("public/admin/libs/datapicker/bootstrap-datepicker.js") }}
    {{ HTML::script("public/admin/libs/dropzone/dropzone.js") }}
    {{ HTML::script("public/admin/libs/bootbox/bootbox.min.js") }}
    
    <!-- App specific scripts -->
    {{ HTML::script("public/admin/js/api.js") }}    
    {{ HTML::script("public/admin/js/app.js") }}
    {{ HTML::script("public/admin/js/form.js") }}

</body>

</html>
