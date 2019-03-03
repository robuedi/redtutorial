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
                                {{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}.
                            </span>
                            <h3 >
                                {{$chapter->name}}
                                <span class="completion-percentage" >{{rand(0, 100)}}%</span>
                            </h3>
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