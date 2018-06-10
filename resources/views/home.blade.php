@extends('_master')

@section('title') Learn HTML @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
    <script src="/assets/js/libs/vue.min.js"></script>
@stop

@section('content')
<main>

    <section class="tutorials-container">
        <div class="container-fluid">
            {{--<div class="row">--}}
                {{--<div class="col">--}}
                    {{--<h1 class="tutorials-main-top-title" >Select your tutorial</h1>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                @foreach( [1=>'SQL', 2=>'PHP', 3=> 'JS'] as $key => $value)
                    <article class="col-md-3 tutorial-item">
                        <div class="tutorial-item-container">
                            <header style="background-image: url(/assets/img/{{strtolower($value)}}-background.png)">

                                <h2>{{$value}}</h2>
                                <h2 class="v2">{{$value}}</h2>
                            </header>
                            <section>

{{--                                <h2>{{$value}}</h2>--}}
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Ut dapibus dolor vel lacus condimentum, at sagittis augue feugiat.
                                    Proin non dapibus odio.
                                </p>
                            </section>
                            <footer>
                                <div class="horizontal-ln">
                                </div>
                                <a href="#">
                                    Beginner
                                </a>
                                <a href="#">
                                    Intermediary
                                </a>
                                <a href="#">
                                    Advanced
                                </a>
                            </footer>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

</main>
@stop