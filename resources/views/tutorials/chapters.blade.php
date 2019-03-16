@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$course->name}} @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="courses-section" >
        <section class="header-section" @if($course_image) style='background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif>
            <div class="heading-inner-container">
                <h1>{{$course->name}}</h1>
            </div>
        </section>

        <section class="tutorial-content" >


            <div class="list-container">

                <ol class="list-items">
                @foreach($chapters as $index => $chapter)
                    <li >
                        <a href="/tutorial/{{$course->slug.'/'.$chapter->slug}}" class="option" >
                            <span class="course-number">
                                {{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}
                            </span>
                            <div class="top-level" >
                                <h3>{{$chapter->name}}</h3>
                                <span class="line-completion-indicator" style="width: {{$chapter->completion_percentage ?? 0}}%;"></span>
                                <span class="dot-completion-indicator" style="left: {{$chapter->completion_percentage ?? 0}}%;"></span>
                                <span class="route">
                                    <span class="inner-route"></span>
                                </span>
                                <span class="completion-percentage" >@if($chapter->completion_percentage ?? false){{$chapter->completion_percentage}}% @else <span title="Symbol for empty">&empty;</span> @endif</span>
                            </div>
                            <p class="sub-details">
                                <span class="lessons-count">{{$chapter->lessons_number}} Lessons</span>
                            </p>
                        </a>
                    </li>
                @endforeach
                </ol>
            </div>

        </section>

    </section>

@stop