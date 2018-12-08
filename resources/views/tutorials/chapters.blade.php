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
        <section class="header-section" @if($course_image) style='background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif>
            <div class="heading-inner-container">
                <h1>{{$course->name}}</h1>
            </div>
        </section>

        <section class="tutorial-content" >

            <div class="list-container">

                <ul class="list-items">
                @foreach($chapters as $index => $chapter)
                    <li data-number="{{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}">
                        <a href="/tutorial/{{$course->slug.'/'.$chapter->slug}}" class="option @if(rand(0,1))  @if(rand(0,1)) messy-option-up @else messy-option-down @endif @endif" @if($course_image) style='background-position: -{{$index*150}}px {{$index*150}}px;background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif >
                            <div class="text-description">
                                <h3 >
                                    {{$chapter->name}}
                                </h3>
                                <p class="lessons-count">{{$chapter->lessons_number}} Lessons</p>
                            </div>
                            <div class="chapter-icon">
                                <i class="{{$chapter->symbol_class}}"></i>
                            </div>
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>

        </section>

    </section>

@stop