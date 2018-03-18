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
        <div class="row">
            <div class="col">
                <h1 class="tutorials-main-top-title" >Tutorials</h1>
            </div>
        </div>
        <div class="row tutorial-row ">

        @foreach( [1=>'HTML', 2=>'CSS', 3=> 'JavaScript', 4 => 'PHP'] as $key => $value)
            <div class="col-3">
                <div class="main-tut-container">
                    <div class="tutorial-symbol-container">
                        <div class=" main-tutorial-btn-container ">
                            <div class="big-rounded-btn html-tutorial-btn">
                                <div class="inner-container {{strtolower($value)}}-tut">
                                    <a href="#"><span class="desc-title" >{{$value}}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tutorial-description-container ">
                    <div class="tutorial-description">
                        <p class="tutorial-txt-desc">
                            Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem.
                            Aenean euismod, mi eu dapibus dignissim.
                        </p>
                        <ul class="tutorial-levels">
                            <li>
                                <h3 class="title"><a href="#" >Beginner</a></h3>
                            </li>
                            <li>
                                <h3 class="title"><a href="#" >Intermediary</a></h3>
                            </li>
                            <li>
                                <h3 class="title"><a href="#" >Advanced</a></h3>
                            </li>
                        </ul>
                    </div>

                </div>
                </div>
            </div>

        @endforeach
        </div>

        </div>
    </div>
</main>
@stop