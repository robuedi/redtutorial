<nav id="main_navigation">

    <div class="nav-inner">
        <a href="/" class="logo-txt">
            <span class="red">RED</span><span class="tutorial">Tutorial</span>
        </a>

        <div class="trigger-sidebar" ></div>

        <ul class="navigation-links">
            {{--<li ><a href="#"  >My Account</a></li>--}}
            <li><a href="/" class="@if(url()->current() === url('/')) active @endif" >Tutorials</a></li>
            <li><a href="/contact-us" class="@if(url()->current() === url('/contact-us')) active @endif" >Contact Us</a></li>
            <li><a href="/sign-in" class="@if(url()->current() === url('/register')) active @endif" >Sign In / Register</a></li>
        </ul>
    </div>


</nav>