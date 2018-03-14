@extends('_master')

@section('title') Learn HTML @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')
<main>


    <div class="container-fluid tutorials-container">
        @foreach( range(1, 4) as $key)
        <div class="row tutorial-row @if($key%2 == 0)justify-content-end @endif">

            @if($key%2 == 0)
                <div class="col-md-2 center-tutorial-btn ">
                    <div class=" main-tutorial-btn-container ">
                        <div class="big-rounded-btn html-tutorial-btn">
                            <div class="inner-shadow1"></div>
                            <div class="inner-container">
                                <a href="#">HTML</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-5 tutorial-description-container">
                <div class="tutorial-description">
                    <h2 >HTML Tutorial</h2>
                    <p>
                        Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem.
                        Aenean euismod, mi eu dapibus dignissim.
                    </p>
                    <div>
                        <h3 class="title">Beginner</h3>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                    <div>
                        <h3 class="title">Intermediary</h3>
                        <p class="description">
                            Nam pretium, orci commodo consequat dictum, dui purus convallis
                        </p>
                    </div>
                    <div>
                        <h3 class="title">Advanced</h3>
                        <p class="description">
                            Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna
                        </p>
                    </div>
                </div>

            </div>

            @if($key%2 != 0)
                <div class="col-md-2 center-tutorial-btn">
                    <div class=" main-tutorial-btn-container ">
                        <div class="big-rounded-btn html-tutorial-btn">
                            <div class="inner-shadow1"></div>
                            <div class="inner-container">
                                <a href="#">HTML</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @endforeach

        </div>
    </div>
</main>
@stop