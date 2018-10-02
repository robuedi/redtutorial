@extends('_partials.master')

@section('title') {{$chapter->course_name}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')

    <section class="course-container">
        <h1 class="course-name">{{$course->course_name.' | '.$chapter->chapter_name}}</h1>
        <div class="course-description">
            {{$chapter->chapter_description}}
        </div>


    </section>

@stop