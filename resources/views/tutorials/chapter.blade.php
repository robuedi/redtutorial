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

    <section class="chapters-section" >
        <div class="header-section" style='background-image: url("/assets/img/php-elephant.jpg")'>
            <div class="subtitle">
                <h2>
                    <a href="/tutorial/{{$chapter->course_slug}}"><i class="fas fa-angle-left"></i> {{$chapter->course_name}}</a>
                </h2>
            </div>
            <div class="heading-inner-container">
                <h1>{{$chapter->chapter_name}}</h1>
            </div>
        </div>

        <section class="chapter-container">
            <div class="lesson-choosing">
                @foreach($lessons as $lesson)
                    <a href="/tutorial/{{$chapter->course_slug.'/'.$chapter->chapter_slug.'/'.$lesson->slug}}" class="option">
                        <h4>{{$lesson->name}}</h4>
                        <span class="lesson-number">{{$lesson->index}}</span>
                        <span class="go-link">
                            <i class="fas fa-chevron-circle-right"></i>
                        </span>
                    </a>
                @endforeach
            </div>
        </section>
    </section>

@stop