@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$course->name}} Tutorial @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="courses-section" >
        <section class="header-section" @if($course_image) style='background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif>
            <div class="heading-inner-container">
                <h1>{!! $course->name !!} Tutorial</h1>
            </div>
            @if($course->description)
                <div class="course-description">
                    {!! $course->description !!}
                </div>
            @endif
        </section>

        <section class="tutorial-content" >

            <div class="list-container">

                <ol class="chapters-list">
                @foreach($chapters as $index => $chapter)
                    <li class="{{\App\Libraries\StatusChecker::checkStatus($chapter->completion_percentage)}} chapter-option">
                        <span class="option" >
                            <span class="course-number">
                                {{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}
                            </span>
                            <div class="top-level" >
                                <h2>{!! $chapter->name !!}</h2>
                                <span class="line-completion-indicator" style="width: {{$chapter->completion_percentage ?? 0}}%;"></span>
                                <span class="dot-completion-indicator" style="left: {{$chapter->completion_percentage ?? 0}}%;"></span>
                                <span class="route">
                                    <span class="inner-route"></span>
                                </span>
                                @if($chapter->completion_percentage ?? false)
                                    <span class="completion-percentage" >{{$chapter->completion_percentage}}%</span>
                                @endif
                            </div>
                        </span>
                        @if(isset($lessons[$chapter->id]))
                        <section class="lessons-container">

                            <div class="lesson-choosing">
                                @foreach($lessons[$chapter->id] as $index => $lesson)
                                    <article class="option-container">
                                        <a href="/{{$course->slug.'/'.$chapter->slug.'/'.$lesson->slug}}" class="option" >
                                            <header class="top-txt" >
                                                <h2>{!! $lesson->name !!}</h2>
                                            </header>
                                            @if($lesson->completion_status&&$lesson->completion_status > 0)
                                                <span class="lesson-completion">@if($lesson->completion_status == 100)<i class="fas fa-check"></i>@else{{$lesson->completion_status}}%@endif</span>
                                            @endif
                                            <footer class="go-link" >
                                            <span class="lesson-number">
                                                {{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}
                                            </span>
                                                <i class="fas fa-chevron-circle-right"></i>
                                            </footer>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                        @endif
                    </li>
                @endforeach
                </ol>
            </div>

        </section>

    </main>

@stop