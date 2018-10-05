@extends('_partials.master')

@section('title') {{$chapter->course_name}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')

    <section class="tutorial-name" style='background-image: url("/assets/img/php-elephant.jpg")'>
        <div class="heading-inner-container">
            <h2>
                <a href="/tutorial/{{$chapter->course_slug}}">{{$chapter->course_name}}</a>
            </h2>
            <h1>{{$chapter->chapter_name}}</h1>
        </div>
    </section>
    <section class="tutorial-container">
        <div class="tutorial-description">
            {{$chapter->chapter_description}}
        </div>
    </section>

@stop