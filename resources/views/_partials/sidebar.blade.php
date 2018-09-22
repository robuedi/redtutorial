<aside id="left_menu" >
    <div class="logo-container">
        <p class="logo-txt">
            <span class="red">RED</span>
            <span class="tutorial">Tutorial</span>
        </p>
        <img src="">
    </div>
    <nav>

        <ul data-sidebar-nav class="root-list">
            @foreach($hierarchy_list as $key => $list_item)

                <li data-list-item data-check="{{(int)$list_item['has_children']}}" >
                    <span class="item-label">
                        <a href="#">{{$list_item['clear_name']}}</a>
                        @if((int)$list_item['has_children'] > 0)
                            <i class="fas fa-plus"></i>
                        @endif
                    </span>

                @if((int)$list_item['has_children'] > 0)
                    {{\App\Libraries\MenuClient::setChildrenCounter((int)$list_item['has_children']+1)}}
                    <ul data-list-inner >
                @else
                    </li>
                @endif

                {{\App\Libraries\MenuClient::countChildren()}}
                @for ($i = 0; $i < \App\Libraries\MenuClient::getEndingsNeeded(); $i++)
                        </ul>
                    </li>
                @endfor

            @endforeach

        </ul>

    </nav>
</aside>

<!--
o
    l
        o
            l/l
            l
                o
                    l/l
                    l/l
                    l/l
                /o
            /l
        /0
    /l
/0
-->