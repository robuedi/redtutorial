@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') Home @parent @stop

@section('stylesheets')
@stop

@section('content')
    <main id="home_container">
        <section class="page-title">
            <h1><span class="part-one">Step by step tutorials</span> <span class="part-two"> <strong>Clear</strong> and <strong>easy</strong> to understand </span></h1>
        </section>


        <section class="page-content" >
            @foreach($courses as $course)
                <div class="course-item" >
                    <div class="inner-container" >
                        <h2 >{{$course->name}} <small>Course</small></h2>
                        <div class="txt-content">
                            {!! $course->description !!}
                        </div>
                        @if($course->status === 1)
                        <a class="start-course" href="/tutorial/{{$course->slug}}">
                            <span>Start now</span> <i class="fas fa-chevron-circle-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>
    </main>
@stop