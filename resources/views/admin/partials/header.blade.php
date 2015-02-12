<header class="clearfix">
    <a href="#" data-toggle-min-nav class="toggle-min"><i class="fa fa-bars"></i></a>

    {!! Form::token() !!}

    <!-- Logo -->
    <div class="logo">
        <a href="{{ url('/admin/dashboard') }}">
            <img src="{{ url('public/front/img/mc-logo-white.png') }}" height="45" />
        </a>
    </div>

    <div class="menu-button" toggle-off-canvas>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </div>

    <div class="top-nav">
        <ul class="nav-right pull-right list-unstyled">

            <li class="dropdown text-normal nav-profile">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user()->avatar(48) }}" alt="" class="img-circle img30_30">
                    <span class="hidden-xs">
                        <span data-i18n="Lisa Doe"></span>
                    </span>
                </a>
                <ul class="dropdown-menu with-arrow pull-right">
                    <li>
                        <a href="{{ url('lock') }}" class="js-post-lock"><i class="fa fa-lock"></i>Lock</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Log Out</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>

</header>
