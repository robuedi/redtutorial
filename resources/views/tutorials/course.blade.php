@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$course->name}} @parent @stop

@section('stylesheets')
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