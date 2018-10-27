@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') Home @parent @stop

@section('stylesheets')
@stop

@section('content')

    <section class="home-container">
        <section class="page-title">
            <h1>Tutorials for {{$courses}}</h1>
        </section>


        <section class="page-content">
            <div class="page-inner-container">
                <p class="txt-description" >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eget sagittis mauris, et commodo ligula. In congue lectus semper ante sodales finibus. Mauris pulvinar quam vitae lorem interdum hendrerit. Fusce tristique fringilla justo, eget sodales enim. Maecenas consectetur ex sed nisi gravida venenatis. Aenean libero metus, accumsan nec sagittis eget, accumsan vel est. Aliquam efficitur ultricies massa, non venenatis arcu posuere non. Mauris at velit diam. Integer malesuada sollicitudin libero eget euismod. Cras sit amet elit sed lorem suscipit vestibulum sed quis elit.
                </p>
            </div>
        </section>
    </section>

@stop