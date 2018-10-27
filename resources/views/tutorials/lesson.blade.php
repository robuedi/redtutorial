@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$lesson->course_name}} @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')
    <section class="tutorial-name" style='background-image: url("/assets/img/php-elephant.jpg")'>
        <div class="subtitle">
            <h2>
                <a href="/tutorial/{{$lesson->course_slag}}">{{$lesson->course_name}}</a>
            </h2>
                |
            <h2>
                <a href="/tutorial/{{$lesson->course_slag.'/'.$lesson->chapter_slag}}">{{$lesson->chapter_name}}</a>
            </h2>
        </div>
        <div class="heading-inner-container">
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