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

    <section class="courses-section" >
        <section class="header-section" style='background-image: url("/assets/img/php-elephant.jpg")'>
            <div class="heading-inner-container">
                <h1>{{$course->name}}</h1>
            </div>
        </section>

        <section class="tutorial-content" >

            <div class="list-container">

                <div class="list-items">
                @foreach($chapters as $index => $chapter)
                    <a href="/tutorial/{{$course->slug.'/'.$chapter->slug}}" class="option @if(rand(0,1))  @if(rand(0,1)) messy-option-up @else messy-option-down @endif @endif" style='background-position: -{{$index*150}}px {{$index*150}}px;background-image: url("/assets/img/php-elephant.jpg")'>
                        <div class="text-description">
                            <h3 >
                                {{$chapter->name}}
                            </h3>
                            <p class="lessons-count">23 Lessons</p>
                        </div>
                        <div class="chapter-icon">
                            <i class="{{$chapter->symbol_class}}"></i>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>

        </section>

    </section>

@stop