@extends('_partials.master')

@section('title') {{$course->name}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css">
@stop

@section('scripts')
@stop

@section('content')

    <section class="tutorial-name" style='background-image: url("/assets/img/php-elephant.jpg")'>
        <div class="heading-inner-container">
            <h1 >{{$course->name}}</h1>
        </div>
    </section>
    <section class="tutorial-container">
        <div class="tutorial-description">
            {{$course->description}}
        </div>
    </section>

@stop