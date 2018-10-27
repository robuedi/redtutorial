@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') Home @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('content')

    <section class="home-container" >
        <section class="page-title">
            <h1>Tutorials </h1>
        </section>


        <section class="page-content" >
            @foreach($courses as $course)
            <div class="course-item" >
                <div class="inner-container" >
                    <h2 >{{$course->name}}</h2>
                    <div class="txt-content">
                        <p>
                            Curabitur viverra dui accumsan imperdiet luctus. Etiam arcu erat, suscipit at tortor quis, pretium efficitur tellus. Nam varius sem ac vulputate vehicula.
                        </p>
                    </div>
                    <a href="/tutorial/{{$course->slug}}">
                        <span>More</span> <i class="fas fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </section>
    </section>

@stop