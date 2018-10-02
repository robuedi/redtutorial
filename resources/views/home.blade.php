@extends('_partials.master')

@section('title') Home @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('content')

    <section class="home-container">
        <section class="page-title">
            <h1>Passion to create</h1>
        </section>


        <section class="page-content">
            <div class="page-inner-container">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eget sagittis mauris, et commodo ligula. In congue lectus semper ante sodales finibus. Mauris pulvinar quam vitae lorem interdum hendrerit. Fusce tristique fringilla justo, eget sodales enim. Maecenas consectetur ex sed nisi gravida venenatis. Aenean libero metus, accumsan nec sagittis eget, accumsan vel est. Aliquam efficitur ultricies massa, non venenatis arcu posuere non. Mauris at velit diam. Integer malesuada sollicitudin libero eget euismod. Cras sit amet elit sed lorem suscipit vestibulum sed quis elit.
                </p>
                <div class="section-tags">
                    @foreach($courses as $course)
                        <span class="red-button-second">{{$course->name}}</span>
                    @endforeach
                </div>
            </div>
        </section>
    </section>

@stop