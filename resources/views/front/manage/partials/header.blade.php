<div class="signin-header">
	<div class="container text-left">
		<a href="{!! url('/m/schools') !!}" class="logo"><img src="{!! url('public/front/img/mc-logo-small.png') !!}" /></a>
		<div class="header-info dropdown">
			Logged in as
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                {{ \Auth::user()->getName("F L") }} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu with-arrow pull-right">
                @if (\Auth::user()->hasRole('admin') || \Auth::user()->hasRole('school_board'))
                	<li>
                        <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-lock"></i> Administration</a>
                    </li>
                	<li class="divider"></li>
                @endif
                <li>
                    <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Log Out</a>
                </li>
            </ul>
		</div>
	</div>
</div>