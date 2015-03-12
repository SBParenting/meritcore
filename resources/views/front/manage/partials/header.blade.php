<div class="signin-header">
	<div class="container text-left">
		<a href="{!! url('/dashboard') !!}" class="logo"><img src="{!! url('public/front/img/mc-logo-small.png') !!}" /></a>
		<div class="header-info dropdown">
			Logged in as
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                {{ \Auth::user()->getName("F L") }} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu with-arrow pull-right">
            	<!--
                <li class="info">
            		<em>School Info</em>
            	</li>
            	<li class="info">
            		<b>St. Francis Xavier CHS</b><br />
            		Teacher
            	</li>
            	<li class="divider"></li>
                -->
                <li>
                    <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Log Out</a>
                </li>
            </ul>
		</div>
	</div>
</div>