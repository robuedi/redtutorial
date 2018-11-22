<aside id="left_menu" style='background-image: url("/assets/img/php-elephant2.jpg")' >
    <div class="logo-container">
        <a href="/" class="logo-txt">
            <span class="red">RED</span>
            <span class="tutorial">Tutorial</span>
        </a>
    </div>
    <nav>


        <ul class="pages-links">
            <li class="my-account" ><a href="#"  >MY ACCOUNT</a></li>
            <li><a href="/" class="@if(url()->current() === url('/')) active @endif" >TUTORIALS</a></li>
            <li><a href="/contact-us" class="@if(url()->current() === url('/contact-us')) active @endif" >CONTACT US</a></li>
            @foreach($static_pages as $page)
                <li><a href="/info/{{$page->slug}}" class="@if(url()->current() === url('/info/'.$page->slug)) active @endif" >{{$page->name}}</a></li>
            @endforeach
        </ul>

    </nav>
</aside>