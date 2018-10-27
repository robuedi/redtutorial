@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$chapter->course_name}} @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="tutorial-name" style='background-image: url("/assets/img/php-elephant.jpg")'>
        <div class="subtitle">
            <h2>
                <a href="/tutorial/{{$chapter->course_slug}}">{{$chapter->course_name}}</a>
            </h2>
        </div>
        <div class="heading-inner-container">
            <h1>{{$chapter->chapter_name}}</h1>
        </div>
    </section>
    <section class="tutorial-container">
        <div class="tutorial-description">
            {{$chapter->chapter_description}}
        </div>
    </section>

@stop