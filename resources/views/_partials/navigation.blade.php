<nav id="main_navigation">

    <div class="nav-inner">
        <a href="/" class="logo-txt">
            <span class="red"><span class="inner-red">red</span></span><span class="tutorial">Tutorial</span>
        </a>

        <div class="trigger-sidebar" ></div>

        <ul class="navigation-links">
            {{--<li ><a href="#"  >My Account</a></li>--}}
            <li><a href="/" class="@if(url()->current() === url('/')) active @endif" >Tutorials</a></li>
            <li><a href="/contact-us" class="@if(url()->current() === url('/contact-us')) active @endif" >Contact Us</a></li>
            @if(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::check())
                <li><a href="/user/profile" class="@if(url()->current() === url('/user/profile')) active @endif" ><i class="far fa-user-circle"></i> {{\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->first_name}}</a></li>
            @else
                <li><a href="/user/sign-in" class="@if(url()->current() === url('/user/sign-in')) active @endif" >Sign In / Register</a></li>
            @endif
        </ul>
    </div>


</nav>