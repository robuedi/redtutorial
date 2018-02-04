<nav>
<ul>
    @foreach ($config_menu as $menu)
        <li class="@if (isset($menu['active']) && $menu['active']) active @endif   @if (isset($menu['submenus']) && count($menu['submenus']) > 0) @endif">
            <a href="@if (isset($menu['submenus']) && count($menu['submenus']) > 0)# @else /{{$menu['url']}}@endif"><i class="fa fa-lg fa-fw {{ $menu['class'] }}"></i> <span class="menu-item-parent">{{ $menu['name'] }}</span></a>


            @if (isset($menu['submenus']) && count($menu['submenus']))
            <ul>
                @foreach($menu['submenus'] as $menu_item)
                    <li class="@if (isset($menu_item['active']) && $menu_item['active']) active @endif">
                    <a href="/{{ $menu_item['url'] }}">{{ $menu_item['name'] }}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
    @endforeach
</ul>
</nav>
<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>