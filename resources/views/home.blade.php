@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
    <link rel="home" href="{{ url()->current() }}" />
@stop

@section('title') Step by step tutorials @parent @stop

@section('stylesheets')
@stop

@section('body_class') body-home @stop

@section('content')
    <main id="home_container">
        <section class="page-title">
            <h1 class="part-one">Step by step tutorials</h1>
            <h3 class="part-two"> <strong>Clear</strong> and <strong>easy</strong> to understand, <strong>track your progress</strong> through the courses </h3>
        </section>


        <section class="page-content" >
            @foreach($courses as $course)
                <div class="course-item"  >
                    <a class="inner-container" href="/{{$course->slug}}" >
                        <h2 ><span @if($course->image_url) style="--background: url('/images/{{$course->image_url}}?w=180&fit=contain&filt=greyscale')" @endif class="course-name">{{$course->name}}</span> <small>Tutorial</small></h2>
                        <div class="txt-content">
                            {!! $course->description !!}
                        </div>

                        @if($course->status === 1)
                        <p class="start-course" >
                            <span>
                                @if(isset($course->completion_status)&&$course->completion_status>0)
                                    Continue the course
                                @else
                                    Start now
                                @endif
                            </span> <i class="fas fa-chevron-circle-right"></i>
                        </p>
                        @endif
                    </a>
                </div>
            @endforeach
        </section>
    </main>
@stop