@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') Home @parent @stop

@section('stylesheets')
@stop

@section('content')

    <section class="home-container" style='background-image: url("/images/uploads/media_library/2018/12/daylight_environment_exploration_1123484.jpg?w=1200&fit=contain&filt=greyscale")' >
        <section class="page-title">
            <h1>Tutorials </h1>
        </section>


        <section class="page-content" >
            @foreach($courses as $course)
            <div class="course-item" >
                <div class="inner-container" >
                    <h2 >{{$course->name}} <small>Course</small></h2>
                    <div class="txt-content">
                        {!! $course->description !!}
                    </div>
                    <a class="start-course" href="/tutorial/{{$course->slug}}">
                        <span>Start now</span> <i class="fas fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </section>
    </section>

@stop