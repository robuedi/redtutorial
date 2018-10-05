@extends('_partials.master')

@section('title') {{$lesson->course_name}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')
    <section class="tutorial-name" style='background-image: url("/assets/img/php-elephant.jpg")'>
        <div class="heading-inner-container">
            <h2>
                <a href="/tutorial/{{$lesson->course_slag}}">{{$lesson->course_name}}</a>
                |
                <a href="/tutorial/{{$lesson->course_slag.'/'.$lesson->chapter_slag}}">{{$lesson->chapter_name}}</a>
            </h2>
            <h1>{{$lesson->lesson_name}}</h1>
        </div>
    </section>
    <section class="tutorial-container">
        <div class="tutorial-description">
            {{$lesson->lesson_description}}
        </div>
        <div class="tutorial-content">
            {{$lesson->lesson_content}}
        </div>
    </section>

@stop