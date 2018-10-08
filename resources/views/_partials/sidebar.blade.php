<aside id="left_menu" >
    <div class="logo-container">
        <a href="{{url('')}}" class="logo-txt">
            <span class="red">RED</span>
            <span class="tutorial">Tutorial</span>
        </a>
    </div>
    <nav>

        <ul data-sidebar-nav class="root-list">
            @foreach($hierarchy_list as $key => $list_item)

                <li class="list-item @if(url()->current() === url('/tutorial/'.$list_item['url_path'])) active @endif" data-list-item @if((int)$list_item['parent_id'] === 0) data-root-list @endif data-check="{{(int)$list_item['has_children']}}" >
                    <span class="item-label">
                        <a href="/tutorial/{{$list_item['url_path']}}">{{$list_item['clear_name']}}</a>
                        @if((int)$list_item['has_children'] > 0)
                            <span class="open-symbol">
                                <i></i>
                                <i></i>
                            </span>
                        @endif
                    </span>

                @if((int)$list_item['has_children'] > 0)
                    {{\App\Libraries\MenuClient::setChildrenCounter((int)$list_item['has_children']+1)}}
                    <ul data-list-inner class="@if($hierarchy_list[$key+1]['type'] === 'lesson') list-display-roman @endif" >
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

        <ul class="pages-links">
            <li><a href="/contact-us">CONTACT US</a></li>
            @foreach($static_pages as $page)
                <li><a href="/info/{{$page->slug}}">{{$page->name}}</a></li>
            @endforeach
        </ul>

    </nav>
</aside>