@extends('_partials.master')

@section('title') {{$lesson->course_name}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')

    <section class="lesson-container">
        <h1 class="lesson-name">{{$lesson->course_name.' | '.$lesson->chapter_name.' | '.$lesson->lesson_name}}</h1>
        <div class="lesson-description">
            {{$lesson->lesson_description}}
        </div>
        <br/>
        <div class="lesson-content">
            {{$lesson->lesson_content}}
        </div>
    </section>

@stop