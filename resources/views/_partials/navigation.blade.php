<nav id="main_navigation">

    <div class="nav-inner">
        <a href="/" class="logo-txt">
            <span class="red">RED</span><span class="tutorial">Tutorial</span>
        </a>

        <button class="trigger-sidebar" type="button">

        </button>

        <ul class="navigation-links">
            {{--<li ><a href="#"  >My Account</a></li>--}}
            <li><a href="/" class="@if(url()->current() === url('/')) active @endif" >Tutorials</a></li>
            <li><a href="/contact-us" class="@if(url()->current() === url('/contact-us')) active @endif" >Contact Us</a></li>
            @foreach($static_pages as $page)
                <li><a href="/info/{{$page->slug}}" class="@if(url()->current() === url('/info/'.$page->slug)) active @endif" >{{$page->name}}</a></li>
            @endforeach
        </ul>
    </div>


</nav>