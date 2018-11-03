<aside id="left_menu" >
    <div class="logo-container">
        <a href="/" class="logo-txt">
            <span class="red">RED</span>
            <span class="tutorial">Tutorial</span>
        </a>
    </div>
    <nav>

        <ul data-sidebar-nav class="root-list">
            @foreach($menu as $course)

                <li class="course-level @if(url()->current() === url('/tutorial/'.$course->slug)) active {{\App\Libraries\MenuClient::setActiveCourse()}} @endif">
                    <span class="item-label">
                        <a href="/tutorial/{{$course->slug}}">{{$course->name}}</a>

                        @if(isset($course->chapters))
                        <span class="open-symbol">
                            <i></i>
                            <i></i>
                        </span>
                        @endif
                    </span>

                    @if(isset($course->chapters))
                        <ul class="chapters-list">
                            @foreach($course->chapters as $chapter)
                            <li class="chapter-level @if(url()->current() === url('/tutorial/'.$course->slug.'/'.$chapter->slug)) active {{\App\Libraries\MenuClient::setActiveCourse()}} @endif">
                                <span class="item-label" >
                                    <a href="/tutorial/{{$course->slug}}/{{$chapter->slug}}">{{$chapter->name}}</a>

                                    @if(isset($chapter->lessons))
                                        <span class="open-symbol">
                                            <i></i>
                                            <i></i>
                                        </span>
                                    @endif
                                </span>

                                @if(isset($chapter->lessons))

                                    <ul class="lessons-list">
                                        @foreach($chapter->lessons as $lesson)
                                            <li class="lesson-level @if(url()->current() === url('/tutorial/'.$course->slug.'/'.$chapter->slug.'/'.$lesson->slug)) active {{\App\Libraries\MenuClient::setActiveCourse()}} @endif">
                                                <span class="item-label">
                                                     <a href="/tutorial/{{$course->slug}}/{{$chapter->slug}}/{{$lesson->slug}}">{{$lesson->name}}</a>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>

                                @endif

                            </li>
                            @endforeach
                        </ul>
                    @endif

                </li>

                @if(\App\Libraries\MenuClient::checkActiveCourse())
                    <li class="see-other-courses">
                        <button class="see-btn">See other courses</button>
                    </li>
                @endif

            @endforeach

        </ul>

        <ul class="pages-links">
            <li><a href="/contact-us" class="@if(url()->current() === url('/contact-us')) active @endif" >CONTACT US</a></li>
            @foreach($static_pages as $page)
                <li><a href="/info/{{$page->slug}}" class="@if(url()->current() === url('/info/'.$page->slug)) active @endif" >{{$page->name}}</a></li>
            @endforeach
        </ul>

    </nav>
</aside>