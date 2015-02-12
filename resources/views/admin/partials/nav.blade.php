<div id="nav-wrapper">
    <ul id="nav">

        @foreach (Config::get('admin.navigation') as $num => $nav)

                <li class="{{ isset($nav_level1) && $nav_level1 == $nav['id'] ? 'active' : '' }}">

                    <a href="{{ URL::to($nav['url']) }}" class="{{ array_key_exists('children', $nav) ? 'has-children' : '' }}"><i class="fa {{ $nav['icon'] }}"><span class="icon-bg bg-{{ Config::get("admin.navigation_colors.$num") }}"></span></i> <span class="text">{{ $nav['title'] }}</span></a>

                    @if (array_key_exists('children', $nav))

                        <ul class="{{ isset($nav_level1) && $nav_level1 == $nav['id'] ? 'open' : 'closed' }}">

                            @foreach ($nav['children'] as $row)
                                
                                <li class="{{ isset($nav_level2) && $nav_level2 == $row['id'] ? 'active' : '' }}">

                                    <a href="{{ URL::to($row['url']) }}"><i class="fa fa-caret-right"></i>{{ $row['title'] }}</a>
                                    
                                </li>

                            @endforeach

                        </ul>

                    @endif
                </li>

            @endforeach

    </ul>
</div>