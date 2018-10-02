@extends('_partials.master')

@section('title') {{$course->name}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')

    <section class="course-container">
        <h1 class="course-name">{{$course->name}}</h1>
        <div class="course-description">
            {{$course->description}}
        </div>


    </section>

@stop