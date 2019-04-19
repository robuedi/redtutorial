@extends('_partials.master')

@section('meta')
    <meta name="description" content="Reset password">
@stop

@section('title') {{$title}} @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="sign-in-page"  >
        <div class="top-section" style='background-image: url("/images/assets/img/contact_us.jpg?w=1200&fit=contain")'>
            <h1>{{$title}}</h1>
        </div>
        <div class="content">

           <p class="info-paragraph txt-lg">
               {!! $msg !!}
           </p>

        </div>
    </main>

@stop