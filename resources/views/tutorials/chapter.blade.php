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
        <div class="header-section" @if($course_image) style='background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif>
            <div class="subtitle">
                <h2>
                    <a href="/tutorial/{{$chapter->course_slug}}"><i class="fas fa-angle-left"></i> Chapters</a>
                </h2>
            </div>
            <div class="heading-inner-container">
                <h1>{{$chapter->chapter_name}}</h1>
            </div>
        </div>

        <section class="chapter-container">
            <div class="lesson-choosing-container">
                <div class="lesson-choosing">
                    @foreach($lessons as $lesson)
                        <a href="/tutorial/{{$chapter->course_slug.'/'.$chapter->chapter_slug.'/'.$lesson->slug}}" class="option @if(rand(0,1)) option-square @else option-circle @endif option-pos-{{rand(1,6)}}" >
                            <div class="bck-img" style='background-image: url("/images/assets/img/background-texture-2110724_640.jpg?w=210&fit=contain")'></div>
                            <div class="top-txt" >
                                <h4>{{$lesson->name}}</h4>
                                <span class="lesson-number">{{$lesson->index}}</span>
                            </div>
                            <span class="go-link" >
                                <i class="fas fa-chevron-circle-right"></i>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </section>

@stop